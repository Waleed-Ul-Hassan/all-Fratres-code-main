<?php

namespace App\Http\Controllers\Recruiter;

use App\AdminSetting;
use App\City;
use App\Industry;
use App\NotificationLogs;
use App\Order;
use App\Package;
use App\Recruiter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Token;

class RecruiterBuyCreditsController extends Controller
{

    public function index(){
        $packages = Package::all();
        return view('frontend.recruiter.buy_credits.index', compact('packages'));
    }

    public function billing($id){
        $packages = Package::all();
        $cities = City::all();
        $industries = Industry::all();

        return view('frontend.recruiter.buy_credits.billing', compact('packages', 'cities','industries','id'));
    }

    public function buy_package(Request $request, $id){


            $request->validate([
                'billing_first_name' => 'required',
                'phone_number' => 'required',
                'card_holder_name' => 'required',
                'card_holder_number' => 'required',
                'card_expiry_month' => 'required',
                'card_expiry_year' => 'required',
                'card_cvc' => 'required'
            ]);

            $package = Package::find(decrypt($id));
            $settings = AdminSetting::first();

            $price_of_package = $package->price;
            $tax_percentage = $settings->tax;
            $tax_amount = number_format(($price_of_package * $tax_percentage) / 100);
            $total_amount = $price_of_package + $tax_amount;

            $package_details = array(
                "package_id" => $package->id,
                "package_name" => $package->name,
                "package_jobs" => $package->jobs,
                "package_price" => $package->price,
            );
            $billing_info = array(
                "billing_name" => $request->billing_first_name,
                "email" => recruiter_logged('email'),
                "phone" => $request->phone_number
            );

            //process payment
        Stripe::setApiKey(Config::get('services.stripe.secret'));

        $recruiter = Recruiter::find(recruiter_logged('id'));
        $customer_id = $recruiter->stripe_customer_id;
        $stripe_response = array("test"=>TRUE);
        $charge = FALSE;
        if($recruiter->stripe_customer_id == ''){

            try {
                $customer = Customer::create([
                    'description' => 'Customer Created for Buying Package',
                    'email' => $recruiter->email,
                    'name' => $recruiter->company_name,
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

                $recruiter->stripe_customer_id = $customer_id;
                $recruiter->save();


            }catch (ApiErrorException $e){
                return redirect()->back()->with(swal_alert_message_error("Oops",$e->getMessage()));
            }
        }

        try{
            $charge = Charge::create([
                'amount' => $total_amount*100,
                'currency' => Config::get('services.stripe.currency'),
                'customer' => $customer_id,
                'description' => 'Description Created for Buying Package',
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
                        'order_type' => 'package_purchase',
                        'order_title' => 'Purchased Package',
                        'package_details' => json_encode($package_details),
                        'billing_info' => json_encode($billing_info),
                        'stripe_response' => json_encode($stripe_response),
                        'recruiter_id' => recruiter_logged('id'),
                        'job_id' => null,
                        'price_of_job' => null,
                        'tax_amount' => $tax_amount,
                        'tax_percentage' => $tax_percentage,
                        "total_amount" => $total_amount,
                        "payment_status" => 'completed',
                        'currency' => $settings->symbol,
                    ]
                );

                $recruiter->job_credits = $package->jobs;
                $recruiter->save();

                NotificationLogs::create([
                    "notifier_id" => recruiter_logged('id'),
                    "notifier_type" => 'recruiter',
                    "message" => 'You have Purchased Package Successfully',
                    "url" => "#",
                ]);

                return redirect('recruiter/package/thankyou/'.encrypt($orders->id));
            }

    }

    public function thankyou($order){
        $order = Order::find(decrypt($order));
        return view('frontend.recruiter.buy_credits.thankyou', compact('order'));
    }




}
