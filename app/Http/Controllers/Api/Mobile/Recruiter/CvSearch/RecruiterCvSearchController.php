<?php

namespace App\Http\Controllers\Api\Mobile\Recruiter\CvSearch;

use App\AdminSetting;
use App\Industry;
use App\NotificationLogs;
use App\Order;
use App\Recruiter;
use App\RecruiterDownload;
use App\Seeker;
use App\Traits\ApiResponse;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Token;

class RecruiterCvSearchController extends Controller
{
    use ApiResponse;

    public function index(Request $request){

        $query = Seeker::query();
        $query_arr = [];
        $leftb = '(';
        $rightb = ')';
        $perpage = 20;


//        return count();

        try{
            if( $request->has('q') && $request->q != '' ){
                $query_arr[] = '( current_job_title LIKE "%'.$request->q.'%" OR first_name LIKE "%'.$request->q.'%" )';
            }
            if( $request->has('exp_years') ){
                $experiences = json_decode($request->exp_years);
                foreach ($experiences as $experience){
//            dd($experience);

                    $arr_exp = explode("-", $experience);
                    $exp_query[] = '( experience_years BETWEEN '.$arr_exp[0].' AND '.$arr_exp[1].')';
                }
                $query_arr[] = $leftb. implode(' OR ', $exp_query) .$rightb;
            }

            if( $request->has('career_level') ){
                $career_levels = json_decode($request->career_level);
                foreach ($career_levels as $career_level){
                    $career_query[] = '( career_level = "'.$career_level.'")';
                }
                $query_arr[] = $leftb. implode(' OR ', $career_query) . $rightb;
            }
            if( $request->has('industry_name') ){
                $industries = json_decode($request->industry_name);
                foreach ($industries as $industry){
                    $industry_query[] = '( industries = '.$industry.')';
                }
                $query_arr[] = implode(' OR ', $industry_query);
            }

            $query_arr[] = ' ( (is_blocked = 0) AND (email_verified_at IS NOT NULL) AND (country_signed = "'.getsubDomain().'") )';
            $quer_is = $leftb.implode(" AND ", $query_arr). $rightb;


            $query->orderByRaw(' is_upgraded DESC ');

            if($quer_is != '()'){
                $seekers = $query->whereRaw($quer_is)->with('experience')->paginate($perpage);
            }else{
                $seekers = $query->with('experience')->paginate($perpage);
            }

            $total_seekers = $seekers->total();

            $order = Order::where('order_type','cvs_purchased')->where('recruiter_id', $request->recruiterIs->id)->orderBy('id', 'DESC')->first();

            $industries = Industry::latest('total_jobs')->limit(20)->get();
            $recruiter = Recruiter::find($request->recruiterIs->id);
            if( $order ){
                $downloaded_seekers = Recruiter::seekers_downloaded($order->id)->groupBy('seeker_id')->pluck('seeker_id')->toArray();

            }else{
                $downloaded_seekers = [];
            }

            $recruiter->reset_validity_cvs();

            $settings = AdminSetting::first();
            $getTax = ($settings->recruiter_cv_purchase_price * $settings->tax) / 100;

            $getTax = (int) round($getTax);
            $total = $settings->recruiter_cv_purchase_price + $getTax;
            $querystringArray = Input::only(['q','exp_years','career_level','industry_name']);

            $response['querystringArray'] = $querystringArray;
            $response['seekers'] = $seekers;
            $response['total_seekers'] = $total_seekers;
            $response['order'] = $order;
            $response['downloaded_seekers'] = $downloaded_seekers;
            $response['total'] = $total;
            $response['getTax'] = $getTax;
            $response['industries'] = $industries;

            return $this->success("CV Search", $response);
        }catch (\Exception $e){
            return $this->error($e->getMessage().$e->getLine());
        }

    }



    public function buy_cv_package(Request $request){


        $settings = AdminSetting::first();
        $validator = Validator::make($request->all(), [

            'card_holder_name' => 'required',
            'card_holder_number' => 'required',
            'card_expiry_month' => 'required',
            'card_expiry_year' => 'required',
            'card_cvc' => 'required'
        ]);

        if($validator->fails()) {
            $response = [];
            $errors = $validator->errors();
            foreach ($errors->all() as $key => $error){
                $response['errors'][$key] = $error;
            }
            return $this->error("Validation failed", $response);
        }





        $getTax = ($settings->recruiter_cv_purchase_price * $settings->tax) / 100;
        $getTax = number_format($getTax);
        $total_amount = $settings->recruiter_cv_purchase_price + $getTax;

        Stripe::setApiKey(Config::get('services.stripe.secret'));

        $recruiter = Recruiter::find($request->recruiterIs->id);
        $customer_id = $recruiter->stripe_customer_id;
        $stripe_response = array("test"=>TRUE);
        $charge = FALSE;

        if($recruiter->stripe_customer_id == ''){

            try {
                $customer = Customer::create([
                    'description' => 'Customer Created for Buying CVs Package',
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
                return response()->json(['error'=>$e->getMessage()]);

            }
        }

        try{
            $charge = Charge::create([
                'amount' => $total_amount*100,
                'currency' => Config::get('services.stripe.currency'),
                'customer' => $customer_id,
                'description' => 'Description Created for Buying CVs Package',
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
            return response()->json(['error'=>$e->getMessage()]);
        }

        //process payment

        if($charge){
            $orders = Order::Create(
                [
                    'order_type' => 'cvs_purchased',
                    'order_title' => 'Purchased CVs Package for '.$settings->recruiter_cv_purchase_days.' Days',
                    'package_details' => null,
                    'billing_info' => $recruiter->billing_details,
                    'stripe_response' => json_encode($stripe_response),
                    'recruiter_id' => $request->recruiterIs->id,
                    'job_id' => null,
                    'price_of_job' => $settings->recruiter_cv_purchase_price,
                    'tax_amount' => $getTax,
                    'tax_percentage' => $settings->tax,
                    "total_amount" => $total_amount,
                    "payment_status" => 'completed',
                    'currency' => $settings->symbol,
                ]
            );

            $days_for_cv = $settings->recruiter_cv_purchase_days + 1;

            $recruiter->cv_purchased_validity = date("Y-m-d", strtotime("+".$days_for_cv." days"));
            $recruiter->save();

            NotificationLogs::create([
                "notifier_id" => $request->recruiterIs->id,
                "notifier_type" => 'recruiter',
                "message" => 'Purchased CVs Package for '.$settings->recruiter_cv_purchase_days.' Days',
                "url" => "#",
            ]);

            $response['orders'] = $orders;
            return $this->success("Purchased Successfully, You are being redirected to Invoices Page", $response);

//            return redirect('recruiter/package/thankyou/'.encrypt($orders->id));
        }



    }


    public function download_cvs(Request $request){

        try {


            $id = $request->seeker_id;
            $status = $request->status;
            $seeker = Seeker::find($id);
            $recruiter = Recruiter::find($request->recruiterIs->id);
            $settings = AdminSetting::first();

            $order = Order::where('order_type','cvs_purchased')->where('recruiter_id', $recruiter->id)
                ->orderBy('id', 'DESC')->first();

            if($order) {
                $getDownloadsCount = Recruiter::todays_downloads($order->id);
                if ($getDownloadsCount >= $settings->daily_limit_cv_download) {
                    return $this->error("You have reached your Daily Download Limit (" . $settings->daily_limit_cv_download . "/ Day). Please come back tomorrow for further downloads");

                }

                $downloads = $recruiter->downloaded_cvs();

                if ($seeker) {
                    if ($status == 0) {


                        $file = public_path('/seekers/cvs/' . getDomainRoot() . $seeker->cv_resume);

                        if (File::exists($file)) {

                            $download = new RecruiterDownload();
                            $download->seeker_id = $seeker->id;
                            $download->recruiter_id = $recruiter->id;


                            $download->order_id = $order->id;
                            $download->save();

                            $url = url('/seekers/cvs/' . getDomainRoot() . $seeker->cv_resume);

                            $res['url'] = $url;
                            return $this->success("File URL", $res);

                        } else {

                            $seeker->cv_resume = "";
                            $seeker->save();

                            return $this->error("Maybe file is removed or corrupted");

                        }


                    } else {

                        $download = new RecruiterDownload();
                        $download->seeker_id = $seeker->id;
                        $download->recruiter_id = $recruiter->id;


                        $download->order_id = $order->id;
                        $download->save();


                        $template = 'template-2';

                        $experiences = $seeker->experience;
                        $projects = $seeker->projects;
                        $education = $seeker->education->first();
                        $skills = $seeker->skills;
                        $certifications = $seeker->certifications;
                        $industry = $seeker->industry;
                        $references = $seeker->references;


                        $pdf = PDF::loadview('frontend.seeker.cv-maker.pdf-templates.' . $template, compact('seeker', 'experiences', 'projects', 'education', 'skills', 'certifications', 'industry', 'references'));

                        $path = public_path('seekers/pdfs/' . getDomainRoot());

                        if (!File::isDirectory($path)) {
                            File::makeDirectory($path, 0777, true, true);
                        }
                        $path = $path . $seeker->id . 'cv.pdf';
                        $pdf->save($path);
                        $url = url('seekers/pdfs/' . getDomainRoot().$seeker->id . 'cv.pdf');

                        $res['url'] = $url;
                        return $this->success("File URL", $res);


                    }

                } else {
                    return $this->error("Seeker not found");

                }

            }else{
                return $this->error("Please Buy CV Package First");

            }
        } catch (\Exception $exception){
            return $this->error($exception->getMessage().' on line '.$exception->getLine());

        }


    }


}
