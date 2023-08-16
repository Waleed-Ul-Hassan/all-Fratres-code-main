<?php

namespace App\Http\Controllers\Seeker;

use App\AdminSetting;
use App\NotificationLogs;
use App\Order;
use App\Seeker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Token;

class SeekerUpgradeProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('seeker');

    }

    public function index(){

        return view('frontend.seeker.profile.upgrade-profile');

    }

    public function upgrade_profile(Request $request){


        $request->validate([

            'card_holder_name' => 'required',
            'card_holder_number' => 'required',
            'card_expiry_month' => 'required',
            'card_expiry_year' => 'required',
            'card_cvc' => 'required'
        ]);

        $settings = AdminSetting::first();


        $price = $settings->seeker_upgrade_price;
        $tax_percentage = $settings->tax;
        $tax_amount = number_format(($price * $tax_percentage) / 100);
        $total_amount = $price + $tax_amount;


        //process payment
        Stripe::setApiKey(Config::get('services.stripe.secret'));

        $seeker = Seeker::find(seeker_logged('id'));
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
                return redirect()->back()->with(swal_alert_message_error("Oops",$e->getMessage()));
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
            return redirect()->back()->with(swal_alert_message_error("Oops",$e->getMessage()));
        }

        //process payment

        if($charge){
            $orders = Order::Create(
                [
                    'order_type' => 'seeker_upgraded_profile',
                    'stripe_response' => json_encode($stripe_response),
                    'recruiter_id' => seeker_logged('id'),
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

            return redirect('seeker/profile/thankyou/'.encrypt($orders->id));
        }

    }

    public function thankyou($id){

        $order = Order::find(decrypt($id));



        return view('frontend.seeker.profile.thankyou', compact('order'));
    }
}
