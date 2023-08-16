<?php

namespace App\Http\Controllers\Api\Mobile\Seeker\Invoice;

use App\AdminSetting;
use App\NotificationLogs;
use App\Order;
use App\Seeker;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Token;

class SeekerInvoiceController extends Controller
{

    use ApiResponse;
    public function invoices(Request $request){

        try{

            $seeker = $request->seekerIs;
            $seeker = Seeker::find($seeker->id);
            $orders = $seeker->orders()->latest()->paginate(25);

            $data['seekers'] = $seeker;
            $data['orders'] = $orders;

            return $this->success('invoices', $data);


        }catch (\Exception $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }
    }

    public function upgrade_profile(Request $request){

        $seeker = $request->seekerIs;

        $validator = Validator::make($request->all(), [
            'card_holder_name' => ['required'],
            'card_holder_number' => ['required'],
            'card_expiry_month' => ['required'],
            'card_expiry_year' => ['required'],
            'card_cvc' => ['required'],
        ]);

        if($validator->fails()) {
            $response = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $error){
                $response[] = $error;
            }
            return $this->error("Validation failed", $response);
        }

        $settings = AdminSetting::first();


        $price = $settings->seeker_upgrade_price;
        $tax_percentage = $settings->tax;
        $tax_amount = number_format(($price * $tax_percentage) / 100);
        $total_amount = $price + $tax_amount;


        //process payment
        Stripe::setApiKey(Config::get('services.stripe.secret'));

        $seeker = Seeker::find($seeker->id);
        $customer_id = $seeker->stripe_customer_id;
        $stripe_response = array("test"=>TRUE);
        $charge = FALSE;
        if($seeker->stripe_customer_id == ''){

            try {
                $customer = Customer::create([
                    'description' => 'Seeker Created for Upgrading Profile',
                    'email' => $seeker->email,
                    'name' => $seeker->first_name,
                ]);
                $token = Token::create([
                    'card' => [
                        'number' => $request->card_holder_number,
                        'exp_month' => $request->card_expiry_month,
                        'exp_year' => $request->card_expiry_year,
                        'cvc' => $request->card_cvc,
                    ],
                ]);
                Customer::createSource(
                    $customer->id,
                    ['source' => 'tok_'.strtolower($token->card->brand)]
                );
                $customer_id = $customer->id;

                $seeker->stripe_customer_id = $customer_id;
                $seeker->save();


            }catch (ApiErrorException $e){
                return $this->error($e->getMessage().' on line '. $e->getLine());
            }
        }

        try{
            $charge = Charge::create([
                'amount' => $total_amount*100,
                'currency' => Config::get('services.stripe.currency'),
                'customer' => $customer_id,
                'description' => 'Description Created for Seeker Upgrade',
            ]);

            $stripe_response = array(
                "charge_id" => $charge->id,
                "balance_transaction_id" => $charge->balance_transaction,
                "date_created" => $charge->created,
                "currency" => $charge->currency,
                "payment_method" => $charge->payment_method,
                "last4" => $charge->payment_method_details->card->last4,
                "brand" => $charge->payment_method_details->card->brand,
                "receipt_email" => $charge->receipt_email,
                "receipt_url" => $charge->receipt_url,
            );
        }catch (ApiErrorException $e){
            return $this->error($e->getMessage().' on line '. $e->getLine());
        }

        //process payment

        if($charge){
            $orders = Order::Create(
                [
                    'order_type' => 'seeker_upgraded_profile',
                    'stripe_response' => json_encode($stripe_response),
                    'recruiter_id' => $seeker->id,
                    'job_id' => null,
                    'price_of_job' => null,
                    'tax_amount' => $tax_amount,
                    'tax_percentage' => $tax_percentage,
                    "total_amount" => $total_amount,
                    "payment_status" => 'completed',
                    'currency' => $settings->symbol,
                ]
            );

            $seeker->is_upgraded = 1;
            $seeker->expiry_upgrade = date('Y-m-d h:i:s', strtotime("+30 days"));
            $seeker->save();

            if( Config::get('mail.APP_SEND_EMAIL') != 'local'){
                $subject = "Receipt of Upgrading Profile";
                $mesg = view('frontend.emails.seeker_upgrade_profile', compact('orders'))->render();
                verify_email($seeker->email, $subject, $mesg, "", "noreply@fratres.net");
            }

            NotificationLogs::create([
                "notifier_id" => seeker_logged('id'),
                "notifier_type" => 'seeker',
                "message" => "You have UPGRADED your profile",
                "url" => "#",
            ]);

            $data['id'] = encrypt($orders->id);
            return $this->success("Profile Upgraded Successfully", $data);
        }

    }



}
