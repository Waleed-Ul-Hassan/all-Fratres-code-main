<?php

namespace App\Http\Controllers\Front;


use App\City;
use Illuminate\Support\Facades\Request;
use Tightenco\Collect\Support\LazyCollection;
use App\Blog;
use App\BlogUser;
use App\BlogCategory;
use App\CollectNewsletter;
use App\Industry;
use App\Order;
use App\Recruiter;
use App\Seeker;
use App\Traits\ExternalJobs;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use PDF;
use Spatie\Sitemap\SitemapGenerator;


class HomeController extends Controller
{

    use ExternalJobs;

    public function index(){

        $industries = Industry::select("name","industry_slug","total_jobs")->orderByRaw('IF(`total_jobs` >= 10, 0, 1), name asc')->get();

//        dd($_SERVER['REMOTE_ADDR'])

        if( Request::ip() == '172.69.39.11' ){
//            $industries = Industry::cursor();
//            dd($industries->first());
        }

//        $industries = $industries->get();
//        , name asc
        $cities = City::orderByRaw('IF(`total_jobs` >= 5, 0, 1), name asc')->limit(44)->select("name","city_slug","total_jobs")->get();
        $companies = Recruiter::WhereRaw("( company_name IS NOT NULL ) AND (total_jobs != 0) AND (country_signed = '".getsubDomain()."')")->where("is_blocked" , 0)->orderBy("company_name", 'asc')->groupBy("company_name")->limit(44)->select("id","company_name","company_slug","total_jobs","company_logo")->get();


//        dd($companies);

        return view('frontend.home.index', compact('industries','cities','companies'));
    }



    public function pdf(){




        $seeker = Seeker::find(seeker_logged('id'));
        $experiences = $seeker->experience;
        $projects = $seeker->projects;
        $education = $seeker->education->first();
        $skills = $seeker->skills;
        $certifications = $seeker->certifications;
        $industry = $seeker->industry;
        $references = $seeker->references;



//        return view('frontend.seeker.cv-maker.pdf-templates.template-3', compact('seeker', 'experiences','projects', 'education', 'skills','certifications','industry','references'));

        $pdf = PDF::loadView('frontend.seeker.cv-maker.pdf-templates.template-1', compact('seeker', 'experiences','projects', 'education', 'skills','certifications','industry','references'));
//       PDF::setOptions(['isPhpEnabled' => true]);


        return $pdf->stream("cv.pdf");


    }



    public function save_email(){

        $email = Input::get('email');

        $newsletter = CollectNewsletter::updateOrCreate(["email"=>$email]);

        $response['status'] = 1;
        return \Response::json($response);

    }


    public function email_template(){
        $seeker = Order::find(4);
        $receipt = json_decode($seeker->stripe_response)->receipt_url;
        return view('frontend.emails.seeker_upgrade_profile', compact('receipt'));

    }



    public function seeker_profile($username){

        $seeker  = Seeker::where('username', $username)->first();

        if($seeker){

            $skills = $seeker->skills;
            $experiences = $seeker->experience;
            $projects = $seeker->projects;
            $certifications = $seeker->certifications;
            $references = $seeker->references;
            $education = $seeker->education;

            return view('frontend.seeker.cv-maker.profile', compact('seeker','experiences','projects','certifications','references','education','skills'));
        }else{
            abort(404);
        }


    }

    public function seeker_profile_recruiter($id){

        $seeker  = Seeker::find(decrypt($id));

//        dd( $seeker );
//        dd( $seeker->industry );

        if($seeker){

            $skills = $seeker->skills;
            $experiences = $seeker->experience;
            $projects = $seeker->projects;
            $certifications = $seeker->certifications;
            $references = $seeker->references;
            $education = $seeker->education;

//            dd($education);

            return view('frontend.seeker.cv-maker.profile', compact('seeker','experiences','projects','certifications','references','education','skills'));
        }else{
            abort(404);
        }

    }

    public function seeker_profile_recruiter_cv($id){


        $seeker  = Seeker::find(decrypt($id));
//        dd($seeker);
        try{
            return view('frontend.seeker.cv-maker.iframe-cv', compact('seeker'));

        }catch(Exception $e){
            dd($e->getMessage());
            abort(404);
        }

    }


    public function blogs(){

        $domain = getsubDomain();

//        dd($domain);

        $blogs = file_get_contents('http://blog.fratres.net/api/'.$domain.'blogs');
//        dd($blogs);
        $blogs = json_decode($blogs);
//        dd($blogs->current_page);

        return view('frontend.home.career-advice.index', compact('blogs'));
    }

    public function blog_detail($slug){
      
        $detail = Blog::where('slug', $slug)->first();
//        $next = Blog::active()->where('id', '>', $detail->id)->first();
//        $prev = Blog::active()->where('id', '<', $detail->id)->first();
//        $categories = BlogCategory::orderBy('name', 'asc')->get();
//        $relatedBlogs = Blog::where('blog_cat', $detail->blog_cat)->orderByRaw('Rand()')->limit(3)->get();
//        $recentBlogs = Blog::orderBy('id', 'desc')->limit(3)->get();
        $next = [];
        $prev = [];
        $categories = [];
        $relatedBlogs = [];
        $recentBlogs = [];


        return view('frontend.home.career-advice.detail-new', compact('detail', 'categories',  'relatedBlogs', 'recentBlogs', 'next', 'prev'));


    }

    public function career_advice(){

        try{
            $domain = getsubDomain();


//            $users = DB::connection('mysql_blog')->table("blogs")->where("country", $domain)->paginate(20);

            $randomBlogs = Blog::active()->orderByRaw('Rand()')->where('country', $domain)->first();
            $randomBlogstwo = Blog::active()->orderByRaw('Rand()')->where('country', $domain)->limit(2)->get();
            $latests = Blog::active()->orderBy('id', 'desc')->where('country', $domain)->limit(10)->get();
            $categories = BlogCategory::all();
            $industries = Industry::limit(60)->get();

//            dd( $categories );


        }catch (\Exception $e){
            dd( $e->getMessage() );
        }

//        dd($randomBlogs);


        return view('frontend.home.career-advice.index-new' , compact('randomBlogs', 'latests', 'categories', 'randomBlogstwo', 'industries'));
    }

    public function blog_category($id) {

        $domain = getsubDomain();

        $categories = BlogCategory::all();
        $categoryBlogs = Blog::active()->where('blog_cat', $id)->where('country', $domain)->orderBy('id', 'desc')->paginate(30);

        return view('frontend.home.career-advice.category', compact('categoryBlogs', 'categories', 'id'));
    }

    public function blog_author($name) {

        $domain = getsubDomain();

        $name = str_replace("-", " ", $name);
        $categories = BlogCategory::all();
        $users = BlogUser::where("name", $name)->first();

//        dd( $users );

        $authorBlogs = Blog::active()->where('user_id', $users->id)->where('country', $domain)->orderBy('id', 'desc')->paginate(30);
        $totalBlogs = Blog::active()->where('user_id', $users->id)->where('country', $domain)->count();

        return view('frontend.home.career-advice.author', compact('authorBlogs', 'categories', 'name', 'totalBlogs'));
    }

    public function blog_status($id, $status) {

        $blog = Blog::find($id);

        $blog->$status = $blog->$status + 1;
        $blog->save();

    }

    public function contact() {


        return view('frontend.contact.index');

    }




}
