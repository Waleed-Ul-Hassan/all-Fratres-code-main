<?php

namespace App\Http\Controllers\Recruiter;

use App\AdminSetting;
use App\Industry;
use App\NotificationLogs;
use App\Order;
use App\Recruiter;
use App\RecruiterDownload;
use App\Seeker;
use App\Skill;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Token;
use PDF;

class RecruiterCvSearchController extends Controller
{

    public function index(){

        $request = request();
        $query = Seeker::query();
        $query_arr = [];
        $leftb = '(';
        $rightb = ')';
        $perpage = 20;


        if( $request->has('q') && $request->q != '' ){
            $query_arr[] = '( current_job_title LIKE "%'.$request->q.'%" OR first_name LIKE "%'.$request->q.'%" )';
        }
        if( $request->has('exp_years') ){
            $experiences = $request->exp_years;
            foreach ($experiences as $experience){

                $arr_exp = explode("-", $experience);
                $exp_query[] = '( experience_years BETWEEN '.$arr_exp[0].' AND '.$arr_exp[1].')';
            }
            $query_arr[] = $leftb. implode(' OR ', $exp_query) .$rightb;
        }

        if( $request->has('career_level') ){
            $career_levels = $request->career_level;
            foreach ($career_levels as $career_level){
                $career_query[] = '( career_level = "'.$career_level.'")';
            }
            $query_arr[] = $leftb. implode(' OR ', $career_query) . $rightb;
        }
        if( $request->has('industry_name') ){
            $industries = $request->industry_name;
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

        $order = Order::where('order_type','cvs_purchased')->where('recruiter_id', recruiter_logged('id'))->orderBy('id', 'DESC')->first();

        $industries = Industry::latest('total_jobs')->limit(20)->get();
        $recruiter = Recruiter::find(recruiter_logged('id'));
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

//        try{
//            dd(request('career_level') && in_array( 1 , request('career_level')) );
//        }catch (\Exception $e){
//            dd( $e->getMessage() );
//        }

        return view('frontend.recruiter.cv-search.index', compact('querystringArray','seekers','total_seekers','order','downloaded_seekers','total','getTax','industries'));

    }

    public function ajax_search(Request $request){

        $query = Seeker::query();
        $query_arr = [];
        $leftb = '(';
        $rightb = ')';
        $perpage = 20;
        $querystringArray = Input::only(['q','exp_years','career_level','industry_name']);

        if( $request->has('q') && $request->q != '' ){
            $query_arr[] = '( current_job_title LIKE "%'.$request->q.'%" OR first_name LIKE "%'.$request->q.'%" )';
        }
        if( $request->has('exp_years') ){
            $experiences = $request->exp_years;
            foreach ($experiences as $experience){

                $arr_exp = explode("-", $experience);
                $exp_query[] = '( experience_years BETWEEN '.$arr_exp[0].' AND '.$arr_exp[1].')';
            }
            $query_arr[] = $leftb. implode(' OR ', $exp_query) .$rightb;
        }

        if( $request->has('career_level') ){
            $career_levels = $request->career_level;
            foreach ($career_levels as $career_level){
                $career_query[] = '( career_level = "'.$career_level.'")';
            }
            $query_arr[] = $leftb. implode(' OR ', $career_query) . $rightb;
        }
        if( $request->has('industry_name') ){
            $industries = $request->industry_name;
            foreach ($industries as $industry){
                $industry_query[] = '( industries = '.$industry.')';
            }
            $query_arr[] = implode(' OR ', $industry_query);
        }
//        dd( $query_arr );
        $query_arr[] = ' ( (is_blocked = 0) AND (email_verified_at IS NOT NULL) )';
        $quer_is = $leftb.implode(" AND ", $query_arr). $rightb;




        if($quer_is != '()'){
//            $seekers = $query->whereRaw($quer_is)->with('experience')->toSql();
            $seekers = $query->whereRaw($quer_is)->with('experience')->paginate($perpage);
        }else{
            $seekers = $query->with('experience')->paginate($perpage);
        }

//        try{
//            dd( $query_arr );
//        }catch (\Exception $e){
//            dd( $e->getMessage() );
//        }
        if(recruiter_logged('cv_purchased_validity') != null){
            $htmlR = view('frontend.recruiter.cv-search.ajax.paid-records', compact('seekers','querystringArray'))->render();
        }else{
            $htmlR = view('frontend.recruiter.cv-search.ajax.records', compact('seekers','querystringArray'))->render();
        }

        $data['seekers'] = $htmlR;
        $data['total'] = $seekers->total();

        return $data;
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

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->all()]);
        }




        $getTax = ($settings->recruiter_cv_purchase_price * $settings->tax) / 100;
        $getTax = number_format($getTax);
        $total_amount = $settings->recruiter_cv_purchase_price + $getTax;

        Stripe::setApiKey(Config::get('services.stripe.secret'));

        $recruiter = Recruiter::find(recruiter_logged('id'));
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
                    'recruiter_id' => recruiter_logged('id'),
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
                "notifier_id" => recruiter_logged('id'),
                "notifier_type" => 'recruiter',
                "message" => 'Purchased CVs Package for '.$settings->recruiter_cv_purchase_days.' Days',
                "url" => "#",
            ]);

            return response()->json(['success'=> 'Purchased Successfully, You are being redirected to Invoices Page']);
//            return redirect('recruiter/package/thankyou/'.encrypt($orders->id));
        }



    }


    public function download_cvs($seeker, $download){

        try {


        $id = decrypt($seeker);
        $seeker = Seeker::find($id);
        $recruiter = Recruiter::find(recruiter_logged('id'));
        $settings = AdminSetting::first();

        $order = Order::where('order_type','cvs_purchased')->where('recruiter_id', $recruiter->id)
            ->orderBy('id', 'DESC')->first();


        $getDownloadsCount = Recruiter::todays_downloads($order->id);
        if( $getDownloadsCount >= $settings->daily_limit_cv_download ){
            return redirect()->back()->with(swal_alert_message_error("OOps!", "You have reached your Daily Download Limit (".$settings->daily_limit_cv_download."/ Day). Please come back tomorrow for further downloads"));
        }


        $downloads = $recruiter->downloaded_cvs();



        if( $seeker ){
        if( $download == 0 ){


            $file= public_path('/seekers/cvs/'.getDomainRoot().$seeker->cv_resume);

            if(\Illuminate\Support\Facades\File::exists($file)){

                $download = new RecruiterDownload();
                $download->seeker_id = $seeker->id;
                $download->recruiter_id = $recruiter->id;



                $download->order_id = $order->id;
                $download->save();

                return Response::download($file);

            }else{

                $seeker->cv_resume = "";
                $seeker->save();

                return redirect()->back()->with(swal_alert_message_error("Oops!", "Maybe file is removed or corrupted"));

            }




        }else{

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


            $pdf = PDF::loadview('frontend.seeker.cv-maker.pdf-templates.'.$template, compact('seeker', 'experiences','projects', 'education', 'skills','certifications','industry','references'));

            return $pdf->download("cv.pdf");

            }

        }else{
            return redirect()->back();
        }

        } catch (\Exception $exception){

//            return redirect()->back()->with(swal_alert_message_error("Oops!", $exception->getMessage()));
            return redirect()->back()->with(swal_alert_message_error("Oops!", "Maybe file is removed or corrupted"));

        }


    }


}
