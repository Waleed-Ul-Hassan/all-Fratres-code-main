<?php

namespace App\Http\Controllers\Api\Mobile\Recruiter\Dashboard;

use App\AdminSetting;
use App\Applicant;
use App\City;
use App\Coupon;
use App\Industry;
use App\Job;
use App\NotificationLogs;
use App\Order;
use App\Recruiter;
use App\Skills;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Token;

class RecruiterJobsController extends Controller
{
    use ApiResponse;

    public function manage_jobs(Request $request){


        $jobs = Job::with('recruiter')->where("jobs.recruiter_id", $request->recruiterIs->id)
            ->leftJoin('cities', 'jobs.city', '=', 'cities.id')
            ->select( DB::raw( 'jobs.*, jobs.id as job_id, cities.name,cities.id' ) )
            ->latest()->get();

        $data['activeJobs'] = Job::countJobs('active');
        $data['pausedJobs'] = Job::countJobs('paused');
        $data['expiredJobs'] = Job::countJobs('expired');
        $data['draftJobs'] = Job::countJobs('draft');
        $data['closedJobs'] = Job::countJobs('closed');
        $data['jobs'] = $jobs;

        return $this->success("Data Found", $data);

    }

    public function create_job(Request $request){


        $paid = FALSE;
        if($request->has('title')) {

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'city' => 'required',
                'job_industry' => 'required',
                'time_available' => 'required',
                'contract_type' => 'required',
                'salary_min' => 'required',
                'salary_max' => 'required',
                'salary_schedule' => 'required',
                'description' => 'required',

            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }

            $settings = AdminSetting::first();


            $job = new Job();
            $request['slug'] = $job->createSlug($request->title, $request->city);
            $request['recruiter_id'] = $request->recruiterIs->id;
            if( !$this->isFree() ){
                $request['job_status'] = 'draft';
            }else{
                $request['job_status'] = 'active';
            }

            $request['expiry_date'] = Carbon::now()->addDays($settings->single_job_expiry_days);
            $request['unique_string'] = Str::random(65);

            Job::create($request->except(['_token','mode']));

            $unique_string = $request['unique_string'];

            $abc['unique_string'] = $unique_string;

            return $this->success("Your job was created successfully", $abc);

        }
        if($request->has('billing_first_name')){

            $validator = Validator::make($request->all(), [
                'billing_first_name' => 'required',
                'billing_sur_name' => 'required',
                'billing_company_name' => 'required',
                'billing_address' => 'required',
                'billing_email' => 'required',
                'zip' => 'required',
                'city' => 'required',
                'province' => 'required'
            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }

            $billing = array("billing_details" => $request->all());
            $billing = json_encode($billing);

            $recruiter = Recruiter::find($request->recruiterIs->id);
            $recruiter->billing_details = $billing;
            $recruiter->save();


            $settings = AdminSetting::first();
            $job = Job::where("unique_string", $request->unique_string)->first();
            $price_of_job = $settings->single_job_price;
            $tax_percentage = $settings->tax;
            $tax_amount = number_format(($price_of_job * $tax_percentage) / 100);
            $total_amount = $price_of_job + $tax_amount;
            $request['billing_email'] = recruiter_logged('email');

            if($job){
                // dd( $job->id );

                $orders = Order::updateOrCreate(
                    [
                        'job_id' => $job->id
                    ],
                    [
                        'order_type' => 'single_job',
                        'order_title' => 'Purchased Job',
                        'billing_info' => json_encode($request->all()),
                        'recruiter_id' => $request->recruiterIs->id,
                        'job_id' => $job->id,
                        'price_of_job' => $price_of_job,
                        'tax_amount' => $tax_amount,
                        'tax_percentage' => $tax_percentage,
                        "total_amount" => $total_amount,
                        "job_details" => json_encode($job),
                        'payment_status' => 'pending',
                        'currency' => $settings->symbol,
                    ]
                );

                $response['unique_string'] = $job->unique_string;
                $response['order_id'] = $orders->id;

                return $this->success("Billing was saved", $response);

            }else{

                return $this->error("You are not Authorized to access this");

            }

        }
        if($request->has('card_holder_name')){

            try{
                $validator = Validator::make($request->all(), [
                    'card_holder_name' => 'required',
                    'card_holder_number' => 'required|numeric',
                    'card_expiry_month' => 'required|numeric',
                    'card_expiry_year' => 'required|numeric',
                    'card_cvc' => 'required|numeric',
                ]);

                if($validator->fails()) {
                    $response = [];
                    $errors = $validator->errors();
                    foreach ($errors->all() as $key => $error){
                        $response['errors'][$key] = $error;
                    }
                    return $this->error("Validation failed", $response);
                }

                Stripe::setApiKey(Config::get('services.stripe.secret'));

                $recruiter = Recruiter::find($request->recruiterIs->id);
                $customer_id = $recruiter->stripe_customer_id;
                if($recruiter->stripe_customer_id == ''){

                    try {
                        $customer = Customer::create([
                            'description' => 'Customer Created for Posting job on page',
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
                    }catch (ApiErrorException $e){
                        return $this->error($e->getMessage());
                    }
                }
                $recruiter->stripe_customer_id = $customer_id;
                $recruiter->save();


                $order = Order::find($request->order_id);

                if($order){
                    $charge = Charge::create([
                        'amount' => $order->total_amount*100,
                        'currency' => Config::get('services.stripe.currency'),
                        'customer' => $customer_id,
                        'description' => 'Description Created for Posting job on page',
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
                    $order->payment_status = 'completed';
                    $order->stripe_response = json_encode($stripe_response);
                    $order->save();

                    $job = Job::find($order->job_id);
                    $job->job_status = 'active';
                    $job->is_payment_done = 1;
                    $job->save();

//                $subject = "Receipt Of Job Purchase";
                        $mesg = file_get_contents($charge->receipt_url);
                        $mesg = str_replace("erfan@fratres.net", "info@fratres.net", $mesg);
//                verify_email($charge->receipt_email, $subject, $mesg, "", "noreply@fratres.net");

//                        $data['alert'] = "";
//                        session(['email' => $charge->receipt_email]);
//                        session(['subject' => 'Receipt Of Job Purchase']);
//                        Mail::send($mesg, $data , function($message){
//                            $message->to(session('email'))
//                                ->subject(session('subject'));
//                        });

                    NotificationLogs::create([
                        "notifier_id" => $request->recruiterIs->id,
                        "notifier_type" => 'recruiter',
                        "message" => 'Your Job '.$job->title.' was posted Successfully',
                        "url" => $job->slug,
                    ]);
                }else{
                    return $this->error("Order not created");
                }

                return $this->success("Job was posted successfully");

            }catch (\Exception $exception){
                return $this->error("Some Error Occured",$exception->getMessage());
            }

        }
    }

    public function update_job(Request $request){


            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'city' => 'required',
                'job_industry' => 'required',
                'contract_type' => 'required',
                'salary_min' => 'required',
                'salary_max' => 'required',
                'salary_schedule' => 'required',
                'description' => 'required',
            ]);

            if($validator->fails()) {
                $response = [];
                $errors = $validator->errors();
                foreach ($errors->all() as $key => $error){
                    $response['errors'][$key] = $error;
                }
                return $this->error("Validation failed", $response);
            }


            $job = new Job();
            $request['slug'] = $job->createSlug($request->title, $request->city);
            $request['recruiter_id'] = $request->recruiterIs->id;


            $jobb = Job::where("unique_string",$request->unique_string)->first();

            $request_is = $request->toArray();

            unset($request_is['_token']);
            unset($request_is['mode']);
            unset($request_is['company_name']);
            unset($request_is['company_size']);
            unset($request_is['company_description']);
            unset($request_is['coupon']);
            unset($request_is['skills']);

            $request['unique_string'] = $request->unique_string;
            $jobb->update($request_is);

            return $this->success('Your job was updated successfully');

    }

    public function create_job_with_credits(Request $request){

        $recruiter = Recruiter::find($request->recruiterIs->id);
        if($recruiter->job_credits <= 0){

            return $this->error('You have no job credits');

        }

        $order_id = $request->order_id;

        $order = Order::find($order_id);

        $order->order_type = 'single_job_credit';
        $order->payment_status = 'completed';
        $order->save();

        $job = Job::find($order->job_id);
        $job->job_status = 'active';
        $job->is_payment_done = 1;
        $job->save();

        if($recruiter->job_credits > 0){
            $recruiter->job_credits = $recruiter->job_credits - 1;
        }
        $recruiter->save();



        NotificationLogs::create([
            "notifier_id" => $request->recruiterIs->id,
            "notifier_type" => 'recruiter',
            "message" => 'You posted Job Successfully using job credit',
            "url" => $job->slug,
        ]);

        return $this->success('Thankyou for posting job');

    }

    public function apply_coupon(Request $request){

        $order_id = $request->__bringorder__;
        $coupon_code = $request->coupon_code;



        $coupon = Coupon::where('coupon_code', $coupon_code)
            ->where("start_date", "<=",Carbon::now()->format("Y-m-d"))
            ->where("end_date", ">=",Carbon::now()->format("Y-m-d"))
            ->first();
        if($coupon){

            try{
                $order_detail = Order::find($order_id);
//                return $order_id;
                $job = $order_detail->job()->first();

                $settings = AdminSetting::first();
                $price_of_job = $settings->single_job_price;


                $total_amount = $price_of_job;
                $discount_percent = $coupon->discount;

                $discounted_price = number_format(($total_amount * $discount_percent) / 100);
                $discounted_price = str_replace(",","", $discounted_price);

                $tax_percentage = $settings->tax;
                $tax_amount = number_format(( ($price_of_job - $discounted_price) * $tax_percentage) / 100);
                $total_amount = ($price_of_job - $discounted_price) + $tax_amount;


                $order_detail->coupon_applied  = 1;

                $data = array(
                    "discounted_price" => $discounted_price,
                    "discount_percent" => $discount_percent,
                    "discount_code" => $coupon_code,
                );
                $order_detail->coupon_detail  = json_encode($data);
                $order_detail->total_amount = $total_amount;
                $order_detail->save();



//                $maild['coupon_code'] = $coupon_code;
//                $maild['discount_percent'] = $discount_percent;
//                $maild['job'] = $job;
//
//                session(['email' => recruiter_logged('email')]);
//                session(['subject' => 'Coupon Applied - Job Posted Successfully']);
//                Mail::send('frontend.emails.coupon_applied', $maild , function($message){
//                    $message->to(session('email'))
//                        ->subject(session('subject'));
//                });

                if($order_detail->total_amount == 0){
                    $job->job_status = 'active';
                    $job->is_payment_done  = 1;
                    $job->save();

                    return $this->success('Your Job is created and is visible to user');
                }else{

                    NotificationLogs::create([
                        "notifier_id" => $request->recruiterIs->id,
                        "notifier_type" => 'recruiter',
                        "message" => 'You successfully applied coupon and got '.$discount_percent.'% discount',
                        "url" => "#",
                    ]);


                    return $this->success("You have got ".$discount_percent."% discount");
                }
            }catch (\Exception $exception){
                return $this->error($exception->getMessage());
            }

        }else{
            return $this->error("Invalid Coupon");

        }


    }

    public function job_delete(Request $request){

        $job = Job::where("unique_string", $request->unique_string)->first();
        if($job){
            $job->job_status = 'deleted';
            $job->save();
            return $this->success('Your job has been deleted Successfully.');
        }else{
            return $this->error('Job does not exists');
        }

    }

    public function job_status(Request $request){

        $job = Job::where("unique_string",$request->unique_string)->first();

        if( $job ){


            $status = '';
            if($request->status && $request->status != ''){

                $status = $request->status;
                switch ($status){
                    case 'active':
                        $job->job_status = 'active';
                        break;
                    case 'paused':
                        $job->job_status = 'paused';
                        break;
                    case 'closed':
                        $job->job_status = 'closed';
                        break;
                }
                $job->save();
                return $this->success('Job Status Updated.');

            }

        }else{
            return $this->error('Job does not exists.');
        }



    }

    public function shortlist(Request $request){

        $status = '';
        $applicant = $request->applicant_id;
        if( isset($request->status) ){
            $status = $request->status;

            $applicant = Applicant::find($applicant);
            $job  = $applicant->job;
            $seeker  = $applicant->seeker;

            if( $job->recruiter_id == $request->recruiterIs->id ){

                $applicant->short_listed = $status;
                if($applicant->viewed_at == null){
                    $applicant->viewed_at = date("Y-m-d");
                }
                $applicant->save();

                if($status == 1){
                    $maild['status'] = "shortlist";
                    $maild['job'] = $job;

                    session(['email' => $seeker->email]);
                    session(['subject' => 'Your Application was Shortlisted']);
                    Mail::send('frontend.emails.job_status', $maild , function($message){
                        $message->to(session('email'))
                            ->subject(session('subject'));
                    });

                }

                return $this->success('Candidate shortlisted successfully');
            }else{
                return $this->success('Job does not belong to you');
            }

        }else{
            return $this->error('Some error occured');
        }



    }



}
