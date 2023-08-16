<?php

namespace App\Http\Controllers\Recruiter;

use App\AdminSetting;
use App\Applicant;
use App\City;
use App\Coupon;
use App\Http\Requests\ValidateRequestsGeneric;
use App\Industry;
use App\Job;
use App\NotificationLogs;
use App\Order;
use App\Recruiter;
use App\Skill;
use App\Skills;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception as GlobalException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use PHPUnit\Exception;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentMethod;
use Stripe\Stripe;
use Stripe\Subscription;
use Stripe\Token;

class RecruiterDashboardController extends Controller
{

    public function index(){



        $jobs = Job::where("jobs.recruiter_id", recruiter_logged('id'))->get();

        $applicants = Applicant::whereIn('job_id', $jobs->pluck('id'))->get();

//        dd($applicants);

        $total_applicants = Applicant::whereIn('job_id', $jobs->pluck('id'))->count();

        $orders = Order::whereRaw(" (order_type = 'single_job' OR order_type = 'single_job_credit' OR order_type = 'cvs_purchased' ) ")->where("recruiter_id", recruiter_logged('id'))->orderBy('id','DESC')->get();



        $total_amount = Order::whereRaw(" (order_type = 'single_job' OR order_type = 'cvs_purchased' ) ")->where("recruiter_id", recruiter_logged('id'))->sum('total_amount');
//        $total_amount = Order::where('order_type','single_job')->orwhere('order_type','package_purchase')->where("recruiter_id", recruiter_logged('id'))->sum('total_amount');


        return view('frontend.recruiter.dashboard.index', compact('applicants','jobs','total_applicants','orders','total_amount'));

    }

    public function manage_jobs(){

        $jobs = Job::where("jobs.recruiter_id", recruiter_logged('id'))
            ->leftJoin('cities', 'jobs.city', '=', 'cities.id')
//                       ->leftJoin('orders', 'jobs.id', '=', 'orders.job_id')
//                       ->rightJoin('applicants', 'jobs.id', '=', 'applicants.job_id')
            ->select( DB::raw( 'jobs.*, jobs.id as job_id, cities.name,cities.id' ) )
            ->latest()->get();
//        dd($jobs);
        $activeJobs = Job::countJobs('active');
        $pausedJobs = Job::countJobs('paused');
        $expiredJobs = Job::countJobs('expired');
        $draftJobs = Job::countJobs('draft');
        $closedJobs = Job::countJobs('closed');

        return view('frontend.recruiter.manage-jobs.index', compact('jobs','activeJobs','pausedJobs','expiredJobs', 'draftJobs','closedJobs'));

    }


    public function job_post(){

        if( ip() == '39.53.135.47' ){
//            dd( $this->isFree() );
        }

        $data['mode'] = 'add';
        $data['unique_string'] = '';
        $data['job_id'] = '';
        $data['cities'] = City::select("id","name")->get();
        $data['industries'] = Industry::select("id","name")->get();
//        $skills = Skills::select("id","name")->get();
//        foreach($skills as $skill){
//            $sk[] = array("id" => $skill->id , "value" => trim($skill->name));
//        }
//        $data['count'] = count($sk);
//        $data['skills'] = json_encode($sk, JSON_FORCE_OBJECT);
//        $data['selectedskills'] = null;
        $data['job'] = array(0);


        return view('frontend.recruiter.jobs.job_post',  $data);

    }

    public function job_edit($unique_string){

        $job = Job::where('unique_string', $unique_string)->first();

        $data['mode'] = 'edit';
        $data['unique_string'] = $job->unique_string;
        $data['job_id'] = $job->id;
        $data['cities'] = City::select("id","name")->get();
        $data['industries'] = Industry::select("id","name")->get();
//        $skills = Skills::select("id","name")->get();
//        $selected = $job->skills->pluck('id')->toArray();
//        $selected_skill = [];
//        foreach($skills as $skill){
//            if(in_array($skill->id, $selected)){
//                $selected_skill[] = array( "value" => trim($skill->name));
//            }
//            $sk[] = array("id" => $skill->id , "value" => trim($skill->name));
//        }
//        $data['count'] = count($sk);
//        $data['skills'] = json_encode($sk, JSON_FORCE_OBJECT);
//        $data['selectedskills'] = json_encode($selected_skill);
        $data['job'] = $job;

        // dd($data['selectedskills']);

        return view('frontend.recruiter.jobs.job_post', $data);

    }


    public function update_job(Request $request){



        $paid = FALSE;
        if($request->has('title')) {

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'city' => 'required',
                'job_industry' => 'required',
//                'skills' => 'required',
                'contract_type' => 'required',
                'salary_min' => 'required',
                'salary_max' => 'required',
                'salary_schedule' => 'required',
                'description' => 'required',
//                'company_name' => 'required',
//                'company_size' => 'required',
//                'company_description' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }



//            $rs = json_decode($request->skills);
//            $ids = array();
//            foreach($rs as $r){
//                if($r->id != ""){
//                    $ids[] = $r->id;
//                }
//            }


//            $skills = Skill::find($ids);
            $settings = AdminSetting::first();

//            $recruiter = Recruiter::find(recruiter_logged('id'));
//            $recruiter->company_name = $request->company_name;
//            $recruiter->company_size = $request->company_size;
//            $recruiter->company_description = $request->company_description;
//            $recruiter->save();

            $job = new Job();
            $request['slug'] = $job->createSlug($request->title, $request->city);
            $request['recruiter_id'] = recruiter_logged('id');


            $jobb = Job::where("unique_string",$request->unique_string)->first();

            // dd( $request->all() );
            $request['ip_origin'] = getVisitorDefault();
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
            $job_object = $jobb;


//            $job_object->skills()->sync($skills);


            return redirect('recruiter/manage-jobs')->with(swal_alert_message("Congrats!","Your job was updated successfully", "Okay","success"));


        }

    }


    public function create_job(Request $request){


        // dd( $request->except(['skills','company_name','company_size','company_description','_token','mode']) );
        // dd( $request->skills );
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
//                'company_name' => 'required',
//                'company_size' => 'required',
//                'company_description' => 'required',
            ]);

            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();
            }



//            $rs = json_decode($request->skills);
//            $ids = array();
//            foreach($rs as $r){
//                if($r->id != ""){
//                    $ids[] = $r->id;
//                }
//            }


//            $skills = Skill::find($ids);
            $settings = AdminSetting::first();

//            $recruiter = Recruiter::find(recruiter_logged('id'));
//            $recruiter->company_name = $request->company_name;
//            $recruiter->company_size = $request->company_size;
//            $recruiter->company_description = $request->company_description;
//            $recruiter->save();


            $job = new Job();
            $request['slug'] = $job->createSlug($request->title, $request->city);
            $request['recruiter_id'] = recruiter_logged('id');
            $request['ip_origin'] = getVisitorDefault();
            if( !$this->isFree() ){
                $request['job_status'] = 'draft';
            }
            if($request->mode == 'add'){
//                $request['job_status'] = 'draft';
                $request['expiry_date'] = Carbon::now()->addDays($settings->single_job_expiry_days);
                $request['unique_string'] = Str::random(65);
                // dd( $request->all() );
                $job_object = Job::create($request->except(['skills','company_name','company_size','company_description','_token','mode']));

                $unique_string = $request['unique_string'];



            }else{
                $jobb = Job::where("unique_string",$request->unique_string)->first();

                if(!$this->isFree()){

                    if($jobb->is_payment_done == 1){
                        $job_status = 'active';
                    }else{
                        $job_status = 'draft';
                    }
                    if($jobb->job_status == $job_status){
                        $request['job_status'] = $job_status;
                    }
                    $order_detail = $jobb->order()->first();
                    if($order_detail && $order_detail->payment_status == 'completed'){
                        $paid = TRUE;
                    }


                }

                $request_is = $request->toArray();

                unset($request_is['_token']);
                unset($request_is['mode']);
                unset($request_is['coupon']);

                $request['unique_string'] = $request->unique_string;

                $jobb->update($request_is);
                $unique_string = $request->unique_string;
//                $job_object = $jobb;
            }

//            $job_object->skills()->sync($skills);
//            if($request->mode == 'add'){
//                foreach ($skills as $skill){
//                    $skill->total_jobs = $skill->total_jobs + 1;
//                    $skill->save();
//                }
//            }

            if($this->isFree()){
                return redirect('recruiter/manage-jobs')->with(swal_alert_message("Congrats!","Your job was posted successfully", "Okay","success"));
            }


            if($paid==TRUE){
                return redirect('recruiter/manage-jobs')->with(swal_alert_message("Congrats!","Your job was updated successfully", "Okay","success"));
            }else{
                return redirect('recruiter/job-preview/'.$unique_string);
            }

        }
        if($request->has('billing_first_name')){

            $request->validate([
                'billing_first_name' => 'required',
                'billing_sur_name' => 'required',
                'billing_company_name' => 'required',
                'billing_address' => 'required',
                'billing_email' => 'required',
                'zip' => 'required',
                'city' => 'required',
                'province' => 'required'
            ]);

            $billing = array("billing_details" => $request->all());
            $billing = json_encode($billing);

            $recruiter = Recruiter::find(recruiter_logged('id'));
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
                        'recruiter_id' => recruiter_logged('id'),
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



                return redirect('recruiter/job-post/pay/'.$job->unique_string);
            }else{

                return redirect('recruiter/job_post')->with(swal_alert_message_error("Alert","You are not Authorized to access this"));

            }

        }
        if($request->has('card_holder_name')){

            $request->validate([
                'card_holder_name' => 'required',
                'card_holder_number' => 'required',
                'card_expiry_month' => 'required',
                'card_expiry_year' => 'required',
                'card_cvc' => 'required',
            ]);

            Stripe::setApiKey(Config::get('services.stripe.secret'));

            $recruiter = Recruiter::find(recruiter_logged('id'));
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
                    return redirect()->back()->with(swal_alert_message_error("Oops",$e->getMessage()));
                }
            }
            $recruiter->stripe_customer_id = $customer_id;
            $recruiter->save();


            $order = Order::find($request->order_id);

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

            if( Config::get('mail.APP_SEND_EMAIL') != 'local'){
//                $subject = "Receipt Of Job Purchase";
                $mesg = file_get_contents($charge->receipt_url);
                $mesg = str_replace("erfan@fratres.net", "info@fratres.net", $mesg);
//                verify_email($charge->receipt_email, $subject, $mesg, "", "noreply@fratres.net");

                $data['alert'] = "";
                session(['email' => $charge->receipt_email]);
                session(['subject' => 'Receipt Of Job Purchase']);
                Mail::send($mesg, $data , function($message){
                    $message->to(session('email'))
                        ->subject(session('subject'));
                });

            }

            NotificationLogs::create([
                "notifier_id" => recruiter_logged('id'),
                "notifier_type" => 'recruiter',
                "message" => 'Your Job '.$job->title.' was posted Successfully',
                "url" => $job->slug,
            ]);

            return redirect('recruiter/thankyou/'.$job->unique_string);


        }
    }


    public function profile(){
        $industries = Industry::all();
        $cities = City::all();
        $tab = '';
        if(isset(request()->tab) && request()->tab != ''){
            $tab = request()->tab;
        }

        return view('frontend.recruiter.profile.index', compact('industries','cities', 'tab'));
    }

    public function billing(){
        $industries = Industry::all();
        $cities = City::all();
        return view('frontend.recruiter.profile.billing', compact('cities', 'industries'));

    }

    public function update_billing(ValidateRequestsGeneric $request){

        $request->validate([
            'billing_first_name' => 'required',
            'billing_sur_name' => 'required',
            'billing_email' => 'required',
            'billing_company_name' => 'required',
            'billing_address' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'province' => 'required',
            'phone_number' => 'required',
        ]);


        $billing = array("billing_details" => $request->all());
        $billing = json_encode($billing);

        $recruiter = Recruiter::find(recruiter_logged('id'));
        $recruiter->billing_details = $billing;
        $recruiter->save();

        $notification = swal_alert_message("Success","Billing Info is Updated","Okay","success");
        return redirect()->back()->with($notification);

    }


    public function update(ValidateRequestsGeneric $request){


        $recruiter = Recruiter::find(recruiter_logged('id'));
        $tab = '';

        $path = public_path('recruiters/profile/' . getDomainRoot());
        $path_square = public_path('recruiters/profile/' . getDomainRoot().'square_');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }


         $image_path = $path. $recruiter->company_logo;
         $image_path_square = $path_square. $recruiter->company_logo;


        if ($request->hasFile('company_logo')) {
            $image = $request->file('company_logo');
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);

            $filename = time() . '.' . $ext;
            $request->company_logo = $filename;

            if (File::exists($image_path)) {
                File::delete($image_path);
                File::delete($image_path_square);
            }

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
//            $image_resize->resize(600);
            $image_resize->save($path . $filename);


            $this->resize_square($image_resize, $filename);
            //resize square img

        }else{
            $filename = $recruiter->company_logo;
        }

        if($request->has('current_password')){

            $validate = $request->validate([
                'password' => [
                    'required',
                    'confirmed',
                    'string',
                    'min:4',             // must be at least 3 characters in length
                    'regex:/[a-z]/',      // must contain at least one lowercase letter
                    'regex:/[A-Z]/',      // must contain at least one uppercase letter
                    'regex:/[0-9]/',      // must contain at least one digit
                    'regex:/[@$!%*#?&]/', // must contain a special character
                ],

            ]);

            if ($validate->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }



            $recruiter = Auth::guard('recruiter')->user();
            $id = $recruiter->id;
            $hashedPassword = $recruiter->password;

            if (\Hash::check($request->current_password, $hashedPassword) && $recruiter->is_social_login==0) {

                if ($request->password == $request->password_confirmation) {
                    $recruiter->password = $request->password;
                }

                $notification = swal_alert_message("Congratulations", 'You Have Successfully Updated Password', "Okay", 'success');

            }else if($recruiter->is_social_login==1){

                if ($request->password == $request->password_confirmation) {
                    $recruiter->password = $request->password;
                    $recruiter->is_social_login = 0;

                    $notification = swal_alert_message("Congratulations", 'You Have Successfully Updated Password', "Okay", 'success');

                }else{
                    $notification = swal_alert_message_error("Invalid Password","Passwords do not match");
                }

            }else{
                $notification = swal_alert_message_error("Invalid Password","Invalid Current Password");
            }
            $recruiter->save();
            return redirect()->back()->with($notification);

        }

        $recruiter->update($request->toArray());
        $recruiter->update(["company_logo"=> $filename]);

        $notification = swal_alert_message("Success","Updated Your Account","Okay","success");
        return redirect()->back()->with($notification);
    }


    public function create_job_with_credits($order_id){

        $recruiter = Recruiter::find(recruiter_logged('id'));
        if($recruiter->job_credits <= 0){

            return redirect()->back()->with(swal_alert_message_error('You have no job credits'));

        }

        $order_id = decrypt($order_id);

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

        $maild['coupon_code'] = $coupon_code;
        $maild['discount_percent'] = null;
        $maild['job'] = $job;

        session(['email' => $recruiter->email]);
        session(['subject' => 'Job Posted with Credits Successfully']);
        Mail::send('frontend.emails.coupon_applied', $maild , function($message){
            $message->to(session('email'))
                ->subject(session('subject'));
        });

        NotificationLogs::create([
            "notifier_id" => recruiter_logged('id'),
            "notifier_type" => 'recruiter',
            "message" => 'You posted Job Successfully using job credit',
            "url" => $job->slug,
        ]);

        return redirect('recruiter/thankyou/'.$job->unique_string);


    }

    public function apply_coupon(Request $request){

            $order_id = decrypt($request->__bringorder__);
            $coupon_code = $request->coupon_code;



            $coupon = Coupon::where('coupon_code', $coupon_code)
                ->where("start_date", "<=",Carbon::now()->format("Y-m-d"))
                ->where("end_date", ">=",Carbon::now()->format("Y-m-d"))
                ->first();
            if($coupon){

                $order_detail = Order::find($order_id);
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



                $maild['coupon_code'] = $coupon_code;
                $maild['discount_percent'] = $discount_percent;
                $maild['job'] = $job;

                session(['email' => recruiter_logged('email')]);
                session(['subject' => 'Coupon Applied - Job Posted Successfully']);
                Mail::send('frontend.emails.coupon_applied', $maild , function($message){
                    $message->to(session('email'))
                        ->subject(session('subject'));
                });

                if($order_detail->total_amount == 0){
                    $job->is_payment_done  = 1;
                    $job->job_status = 'active';
                    $job->save();

                    return redirect('recruiter/dashboard')->with(swal_alert_message("Congratulations", "Your Job is created and is visible to user","Okay","success"));
                }else{

                    NotificationLogs::create([
                        "notifier_id" => recruiter_logged('id'),
                        "notifier_type" => 'recruiter',
                        "message" => 'You successfully applied coupon and got '.$discount_percent.'% discount',
                        "url" => "#",
                    ]);

                    return redirect()->back()->with(swal_alert_message("Congratulations","You have got ".$discount_percent."% discount", "Okay","success"));
                }




            }else{
                return redirect()->back()->with(swal_alert_message_error("Oops","Invalid Coupon"));
            }


    }

    public function job_preview($unique_string){
        $job = Job::where("unique_string", $unique_string)->first();

        $order = Order::where('job_id', $job->id)->where('payment_status', 'completed')->first();
        if($order){
//            $job->job_status = 'active';
//            $job->save();
            return redirect('recruiter/dashboard')->with(swal_alert_message("", "Jobs updated successfully.", "Okay","success"));
        }

        return view('frontend.recruiter.jobs.preview', compact('job'));
    }

    public function job_billing($unique_string){
        $job = Job::where("unique_string", $unique_string)->first();

        if(!$job){
            return redirect('recruiter/job_post')->with(swal_alert_message_error("Alert","You are not Authorized to access this"));
        }

        $cities = City::all();
        return view('frontend.recruiter.jobs.billing', compact('job','cities'));
    }

    public function pay_price_job($unique_string){
        $job = Job::where("unique_string", $unique_string)->first();

        if(!$job){
            return redirect('recruiter/job_post')->with(swal_alert_message_error("Alert","This Job no longer exists"));
        }

        $order = Order::where('job_id', $job->id)->first();
//        dd($order);
        if($order){
            return view('frontend.recruiter.jobs.payment', compact('order'));
        }else{
            return redirect('recruiter/job-preview/'.$job->unique_string);
        }

    }


    public function job_delete($unique_string){

        $job = Job::where("unique_string", $unique_string)->first();
        $job->job_status = 'deleted';
        $job->save();


        return redirect('recruiter/dashboard')->with(swal_alert_message("Congratulations","Your job has been deleted Successfully.","Okay","success"));

    }


    public function thankyou($unique_string){
        $job = Job::where('unique_string', $unique_string)->first();
        $order = $job->order()->first();


        return view('frontend.recruiter.jobs.thankyou', compact('order'));

    }


    public function job_status($id){

        $job = Job::find(decrypt($id));

        if( $job ){


            $status = '';
            if(isset($_GET['status']) && $_GET['status']){

                $status = $_GET['status'];
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
                return 'ok';

            }


        }



    }

    public function shortlist($id){

        $status = '';

        if( isset($_GET['status']) ){
            $status = $_GET['status'];

            $applicant = Applicant::find($id);
            $job  = $applicant->job;
            $seeker  = $applicant->seeker;

            if( $job->recruiter_id == recruiter_logged('id') ){

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

                return 'ok';
            }

//            return $id . ' - '. $status;
        }



    }


    public function resize_square($image_resize, $filename){


        $path_square = public_path('recruiters/profile/' . getDomainRoot().'square_');

        //resize square img
        $width  = $image_resize->width();
        $height = $image_resize->height();


        /*
        *  canvas
        */
        $dimension = 2362;

        $vertical   = (($width < $height) ? true : false);
        $horizontal = (($width > $height) ? true : false);
        $square     = (($width = $height) ? true : false);

        if ($vertical) {
            $top = $bottom = 0;
            $newHeight = ($dimension) - ($bottom + $top);
            $image_resize->resize(null, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
            });

        } else if ($horizontal) {
            $right = $left = 0;
            $newWidth = ($dimension) - ($right + $left);
            $image_resize->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        } else if ($square) {
            $right = $left = 0;
            $newWidth = ($dimension) - ($left + $right);
            $image_resize->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        }

        $image_resize->resizeCanvas($dimension, $dimension, 'center', false, '#ffffff');
        $image_resize->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image_resize->save($path_square . $filename);


    }

}
