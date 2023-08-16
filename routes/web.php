<?php

//use PragmaRX\Tracker\Vendor\Laravel\Facade as Tracker;

//Config::set('dynamic_details.country', 'PK');

//dd( 'dasd' );

//Route::get('/json', function () {
//$jsonString = file_get_contents(base_path('storage/abc.json'));
//
//$data = json_decode($jsonString, true);
//
//foreach ($data as $city){
//    $cityy = new \App\City();
//    $cityy->name = $city['city'];
//    $cityy->city_slug = $city['city'];
//    $cityy->save();
//}
//
//
//});


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Seeker\SeekerAuthController;


Route::get('se', function () {

//    echo phpversion();
    die();
    $data = array(
        'name' => "Learning Laravel",
    );

    \Illuminate\Support\Facades\Mail::send('frontend.emails.job_alerts.seeker_preferences_notification', $data, function ($message) {

        $message->from('saqlainbukhari26@gmail.com', 'Learning Laravel');

        $message->to('iamrizwan1000@gmail.com')->subject('Learning Laravel test email');

    });

    return "Your email has been";

});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//if(isset($_SERVER['HTTP_HOST']) && !empty($_SERVER['HTTP_HOST'])){
//    echo $domain = $_SERVER['HTTP_HOST'];
//}
//die();


Route::get('/clear', function () {

//    dd( SiteSetting::first() );


    echo Artisan::call("route:clear");
    echo Artisan::call("view:clear");
    echo Artisan::call("clear-compiled");
    echo Artisan::call("config:clear");
    echo Artisan::call("cache:clear");
    echo Artisan::call("config:cache");
    echo '<br>';
    echo convert(memory_get_usage());
});



Route::get('/admi', function () {

    $p =  App\Seeker::where("email", "esha_awan786@hotmail.co.uk")->first();
//    $p =  App\Admin::find(2);
//    $p->name = "Admin";
//    $p->type = "admin";
//    $p->email = "info@fratres.net";
    $p->password = "esha!Awan786";
//    $p->password = \Hash::make("esha_Awan786");
    $p->save();

    dd($p);
});


//Route::get('/job-listing', function () {
//    return view('frontend.joblisting');
//});
//
//Route::get('/job-detail-description', function () {
//    return view('frontend.job-detail-description');
//});
//
//Route::get('/seeker-login', function () {
//    return view('frontend.seeker.auth.login');
//});
//
//Route::get('/register-one', function () {
//    return view('frontend.seeker.auth.register-one');
//});
//
//Route::get('/register-two', function () {
//    return view('frontend.seeker.auth.register-two');
//});
//
//Route::get('/register-three', function () {
//    return view('frontend.seeker.auth.register-three');
//});


Route::get('admin/login', function () {
    return view('admin.auth.login');
});

Route::get('/add_db', function () {

//    $flags = \App\Flag::orderBy("name", "asc")->get();
//    foreach ($flags as $flag){
//        echo " <a href='https://".$flag->url."/add_db'>https://".$flag->url."/add_db</a>";
//        echo "<br>";
//    }

//    \Illuminate\Support\Facades\DB::statement("ALTER TABLE `cities` ADD `sort_order` BIGINT NOT NULL DEFAULT '0' AFTER `total_jobs`");
//    \Illuminate\Support\Facades\DB::statement("ALTER TABLE `admin_settings` ADD `website_is_free` BOOLEAN NOT NULL DEFAULT TRUE AFTER `seeker_upgrade_price`");
});

Route::get('admin/change-password', function () {
    return view('admin.auth.change-password');
});

Route::post('admin/login', 'Admin\AdminUserController@login');
Route::get('admin/logout', 'Admin\AdminUserController@logout');

Route::get('/admin-login', 'Admin\AdminUserController@adminCaLogin');



//ALTER TABLE `validate_tokens` CHANGE `access_token` `access_token` VARCHAR(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
//Route::get('blogs', 'HomeController@getBlogs');
//Route::get('blogs/{id}', 'HomeController@getBlogss');
//Route::post('blogs-hide/{id}', 'HomeController@hideBlogss');
//Route::post('blogs-show/{id}', 'HomeController@showBlogss');
//Route::post('blogs-delete/{id}', 'HomeController@delete');
//Route::post('create/user', 'HomeController@createUser');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin' ], function () {


    //stats
        Route::get('stats', 'Stats\AdminStatsController@index');
        Route::get('summary', 'Stats\AdminStatsController@summary');
        Route::get('log-users', 'Stats\AdminStatsController@users');
        Route::get('events', 'Stats\AdminStatsController@events');
        Route::get('track/apiVisits', 'Stats\AdminStatsController@apiVisits');

        Route::get('track/recruiters', 'Stats\AdminStatsController@TrackRecruiters');
        Route::get('track/apiRecruiters', 'Stats\AdminStatsController@apiRecruiters');
    //stats

    Route::get('/home', 'AdminHomeController@index');
    Route::get('/all-portals', 'AdminHomeController@allStats');

    Route::get('clicks/recruiter-job-post', 'AdminHomeController@clicks_job_post');

    Route::get('/bugs', 'AdminBugsController@index');
    Route::get('/bug-delete/{id}', 'AdminBugsController@bug_delete');

    Route::post('/change-password', 'AdminUserController@changePassword');

    Route::get('/users', 'AdminUserController@users');
    Route::get('/add-users', 'AdminUserController@add');
    Route::post('/add-users', 'AdminUserController@save');
    Route::get('/edit-users/{id}', 'AdminUserController@editUsers');
    Route::post('/update-users', 'AdminUserController@updateUsers');
    Route::post('/block-users/{id}', 'AdminUserController@blockUsers');
    Route::post('/delete-users/{id}', 'AdminUserController@delete');
    Route::get('/settings', 'AdminSettingsController@index');
    Route::post('/settings', 'AdminSettingsController@settings');
    Route::get('/skills', 'AdminEssentialsController@skills');
    Route::get('/add-skills', 'AdminEssentialsController@addSkills');
    Route::post('/add-skills', 'AdminEssentialsController@saveSkills');
    Route::get('/edit-skills/{id}', 'AdminEssentialsController@editSkills');
    Route::post('/update-skills', 'AdminEssentialsController@updateSkills');
    Route::post('/delete-skills/{id}', 'AdminEssentialsController@deleteSkills');

    Route::get('/industries', 'AdminEssentialsController@industries');
    Route::get('/add-industries', 'AdminEssentialsController@addIndustries');
    Route::post('/add-industries', 'AdminEssentialsController@saveIndustries');
    Route::get('/edit-industries/{id}', 'AdminEssentialsController@editIndustries');
    Route::post('/update-industries', 'AdminEssentialsController@updateIndustries');
    Route::post('/delete-industries/{id}', 'AdminEssentialsController@deleteIndustries');

    Route::get('/cities', 'AdminEssentialsController@cities');
    Route::get('/cities/sort', 'AdminEssentialsController@cities_sort');
    Route::post('/cities/sort_save', 'AdminEssentialsController@sort_save');
    Route::get('/add-cities', 'AdminEssentialsController@addCities');
    Route::post('/add-cities', 'AdminEssentialsController@saveCities');
    Route::get('/edit-cities/{id}', 'AdminEssentialsController@editCities');
    Route::post('/update-cities', 'AdminEssentialsController@updateCities');
    Route::post('/delete-cities/{id}', 'AdminEssentialsController@deleteCities');


    Route::get('/pages', 'AdminEssentialsController@pages');
    Route::get('/add-pages', 'AdminEssentialsController@addPages');
    Route::post('/add-pages', 'AdminEssentialsController@savePages');
    Route::get('/edit-pages/{id}', 'AdminEssentialsController@editPages');
    Route::post('/update-pages', 'AdminEssentialsController@updatePages');

    Route::get('/packages', 'AdminPackagesController@packages');
    Route::get('/add-packages', 'AdminPackagesController@addPackages');
    Route::post('/add-packages', 'AdminPackagesController@savePackages');
    Route::get('/edit-packages/{id}', 'AdminPackagesController@editPackages');
    Route::post('/update-packages', 'AdminPackagesController@updatePackages');
    Route::get('/delete-packages/{id}', 'AdminPackagesController@deletePackages');

    Route::get('/package-feature', 'AdminPackagesController@packageFeature');
    Route::get('/add-package-feature', 'AdminPackagesController@addPackageFeature');
    Route::post('/add-package-feature', 'AdminPackagesController@savePackageFeature');
    Route::get('/edit-package-feature/{id}', 'AdminPackagesController@editPackageFeature');
    Route::post('/update-package-feature', 'AdminPackagesController@updatePackageFeature');
    Route::post('/delete-package-feature/{id}', 'AdminPackagesController@deletePackageFeature');

    Route::get('/seo', 'AdminSeoController@index');
    Route::get('/add-seo', 'AdminSeoController@addSeo');
    Route::post('/seo', 'AdminSeoController@seo');
    Route::get('/edit-seo/{id}', 'AdminSeoController@edit');
    Route::post('/update-seo', 'AdminSeoController@update');
    Route::post('/delete-seo/{id}', 'AdminSeoController@deleteSeo');

    Route::get('/contact-us', 'AdminContactUsController@index');
    Route::post('/save-contact-us', 'AdminContactUsController@saveContactUs');
    Route::post('/delete-contact-us/{id}', 'AdminContactUsController@deleteSkills');

//        admin newsletters
    Route::get('/newsletter', 'AdminNewslettersController@index');
    Route::get('/newsletter/delete/{id}', 'AdminNewslettersController@delete');
//        end admin newsletters

    Route::get('/analytics', 'AdminAnalyticsController@index');
    Route::get('/location-overview', 'AdminAnalyticsController@locationOverview');
    Route::get('/mobile-overview', 'AdminAnalyticsController@mobileOverview');
    Route::get('/pages-report', 'AdminAnalyticsController@pagesReport');

    //Seeker
    Route::get('/seekers', 'AdminSeekerController@index');
    Route::get('detail-seekers/{id}', 'AdminSeekerController@detailSeekers');
    Route::post('block-seekers/{id}', 'AdminSeekerController@blockSeekers');
    Route::get('/seeker/verify_seeker', 'AdminSeekerController@verify_seeker');


    Route::get('/cvs', 'AdminSeekerController@cvs');





    Route::get('/recruiter', 'AdminRecuiterController@index');
    Route::get('detail-recruiter/{id}', 'AdminRecuiterController@detailRecuiter');
    Route::post('block-recruiter/{id}', 'AdminRecuiterController@blockSeekers');

    Route::get('/orders', 'AdminRecuiterController@orders');


    Route::get('/jobs', 'AdminJobsController@index');
    Route::post('block-jobs/{id}', 'AdminJobsController@deletejobs');
    Route::post('reject-jobs/{id}', 'AdminJobsController@rejectjobs');
    Route::get('detail-jobs/{id}', 'AdminJobsController@detailjobs');


    Route::get('/coupons', 'AdminCouponController@coupons');
    Route::get('/add-coupons', 'AdminCouponController@addCoupons');
    Route::post('/add-coupons', 'AdminCouponController@saveCoupons');
    Route::get('/edit-coupons/{id}', 'AdminCouponController@editCoupons');
    Route::post('/update-coupons', 'AdminCouponController@updateCoupons');
    Route::post('/delete-coupons/{id}', 'AdminCouponController@deleteCoupons');

    Route::get('/advertisement', 'AdminAdvertisementController@show');
    Route::get('/add-advertisement', 'AdminAdvertisementController@add');
    Route::post('/add-advertisement', 'AdminAdvertisementController@create');
    Route::get('/edit-advertisement/{id}', 'AdminAdvertisementController@edit');
    Route::post('/update-advertisement', 'AdminAdvertisementController@update');
    Route::post('/delete-advertisement/{id}', 'AdminAdvertisementController@delete');
    Route::post('/active-advertisement/{id}', 'AdminAdvertisementController@active');
    Route::post('/pause-advertisement/{id}', 'AdminAdvertisementController@pause');



    Route::get('/blogs', 'AdminBlogController@blogs');
    Route::get('/blogs/{id}', 'AdminBlogController@singleblogs');
    Route::get('/blogs/users', 'AdminBlogController@users');


    Route::get('/job-alerts', 'AdminJobAlertsController@index');


    Route::get('/verify/u_sure/reset_database', 'AdminHomeController@reset_database');

    Route::get('/sales', 'AdminSalesController@index');
    Route::get('/sales/add', 'AdminSalesController@add');
    Route::post('/sales/upload_emails', 'AdminSalesController@upload_emails');
    Route::get('/sales/delete/{id}', 'AdminSalesController@delete_emails');
    Route::post('/sales/send/emails', 'AdminSalesController@send_emails');
    Route::get('/sales/template-id', 'AdminSalesController@getEmails');
//    Route::get('/sales', 'AdminSalesController@index');



});


Route::group(['namespace' => 'Seeker', 'prefix' => 'seeker','middleware' => 'isOnlineSeeker'], function () {

    Route::get('/cv-maker/register', 'SeekerAuthController@cv_maker_index');



    Route::get('/register', 'SeekerAuthController@index');
    Route::post('/register_one', 'SeekerAuthController@register_one');
    Route::get('/register-step', 'SeekerAuthController@register_step_two');
    Route::post('/register-step-create', 'SeekerAuthController@register_create');
    Route::get('/confrim-email/{confirm_email_random_id}', 'SeekerAuthController@confrimEmail');
    Route::get('/login', 'SeekerAuthController@login');
    Route::get('/forget-password', 'SeekerAuthController@forgetPassword');
    Route::post('/forget-password', 'SeekerAuthController@forgetPasswords');
    Route::get('/reset-password/{confirm_email_random_id}', 'SeekerAuthController@resetPassword');
    Route::post('/reset-password', 'SeekerAuthController@resetPasswords');
    Route::post('/login', 'SeekerAuthController@login_post');

    Route::get('login/linkedin', 'SeekerAuthController@LinkedinredirectToProvider');
    Route::get('linkedin/callback', 'SeekerAuthController@LinkedinhandleProviderCallback');

    Route::get('login/facebook', 'SeekerAuthController@FacebookredirectToProvider');
    Route::get('facebook/callback', 'SeekerAuthController@FacebookhandleProviderCallback');

    Route::get('/profile', 'SeekerDashboardController@profile');
    Route::get('/dashboard', 'SeekerDashboardController@index');

    Route::get('/job-alerts', 'SeekerAlertsController@index');
    Route::get('/alerts/delete/{id}', 'SeekerAlertsController@delete');

    Route::post('/change_avatar', 'SeekerDashboardController@change_avatar');
    Route::post('/account/update', 'SeekerDashboardController@account_update');
    Route::get('/update-password', 'SeekerDashboardController@updatePassword');
    Route::post('/update-password', 'SeekerDashboardController@updatePasswords');



    Route::get('/send_mail', 'SeekerAuthController@send_mail');

    Route::get('/cv-maker', 'SeekerCvMakerController@index');
    Route::post('/cv-maker/update_account', 'SeekerCvMakerController@update_account');

    Route::post('/cv-maker/save_experience', 'SeekerCvMakerController@save_experience');
    Route::get('/cv-maker/get_experience/{id}', 'SeekerCvMakerController@get_experience');
    Route::get('/cv-maker/delete_experience/{id}', 'SeekerCvMakerController@delete_experience');

    Route::post('/cv-maker/save_project', 'SeekerCvMakerController@save_project');
    Route::get('/cv-maker/get_project/{id}', 'SeekerCvMakerController@get_project');
    Route::get('/cv-maker/delete_project/{id}', 'SeekerCvMakerController@delete_project');

    Route::post('/cv-maker/save_certification', 'SeekerCvMakerController@save_certification');
    Route::get('/cv-maker/get_certification/{id}', 'SeekerCvMakerController@get_certification');
    Route::get('/cv-maker/delete_certification/{id}', 'SeekerCvMakerController@delete_certification');

    Route::post('/cv-maker/save_skills', 'SeekerCvMakerController@save_skills');

    Route::post('/cv-maker/save_hobbies', 'SeekerCvMakerController@save_hobbies');
    Route::post('/cv-maker/save_language', 'SeekerCvMakerController@save_language');

    Route::post('/cv-maker/save_reference', 'SeekerCvMakerController@save_reference');
    Route::get('/cv-maker/delete_reference/{id}', 'SeekerCvMakerController@delete_reference');

    //seeking job checkbox
    Route::get('/cv-maker/seeking_job', 'SeekerCvMakerController@seeking_job');

    //education
    Route::post('/cv-maker/save_education', 'SeekerCvMakerController@save_education');
    Route::get('/cv-maker/get_education/{id}', 'SeekerCvMakerController@get_education');
    Route::get('/cv-maker/delete_education/{id}', 'SeekerCvMakerController@delete_education');

    //Check Availability
    Route::get('/cv-maker/check-availability/{id}', 'SeekerCvMakerController@check_availability');


    //upgrade seeker profile
    Route::get('/upgrade-profile', 'SeekerUpgradeProfileController@index');
    Route::post('/upgrade-profile', 'SeekerUpgradeProfileController@upgrade_profile');
    Route::get('/profile/thankyou/{id}', 'SeekerUpgradeProfileController@thankyou');

    //download CVS
    Route::get('/cv-maker/cv-download/{id}', 'SeekerCvMakerController@cv_download');

    //notifications
    Route::get('/notifications', 'SeekerNotificationsController@index');

    Route::get('/invoices', 'SeekerDashboardController@invoices');


    Route::get('/cv/remove', 'SeekerDashboardController@remove_cv');




});


Route::group(['namespace' => 'Recruiter', 'prefix' => 'recruiter','middleware' => ['isOnlineRecruiter'] ], function () {


    Route::get('/login', 'RecruiterAuthController@login');
    Route::get('/register', 'RecruiterAuthController@register');
    Route::post('/login', 'RecruiterAuthController@login_post');
    Route::post('/register', 'RecruiterAuthController@create');

    Route::get('/confrim-email/{id}', 'RecruiterAuthController@confrimEmail');
    Route::get('/forget-password', 'RecruiterAuthController@forgetPassword');
    Route::post('/forget-password', 'RecruiterAuthController@forgetPasswords');
    Route::get('/reset-password/{confirm_email_random_id}', 'RecruiterAuthController@resetPassword');
    Route::post('/reset-password', 'RecruiterAuthController@resetPasswords');


    Route::get('login/linkedin', 'RecruiterAuthController@LinkedinredirectToProvider');
    Route::get('linkedin/callback', 'RecruiterAuthController@LinkedinhandleProviderCallback');

    Route::get('login/facebook', 'RecruiterAuthController@FacebookredirectToProvider');
    Route::get('facebook/callback', 'RecruiterAuthController@FacebookhandleProviderCallback');



Route::group(['middleware' => ['isOnlineRecruiter','recruiter'] ], function () {


        Route::get('dashboard', 'RecruiterDashboardController@index');
        Route::get('manage-jobs', 'RecruiterDashboardController@manage_jobs');
        Route::get('profile', 'RecruiterDashboardController@profile');
        Route::post('update', 'RecruiterDashboardController@update');
        Route::get('billing', 'RecruiterDashboardController@billing');
        Route::post('update-billing', 'RecruiterDashboardController@update_billing');

        Route::get('job_post', 'RecruiterDashboardController@job_post');
        Route::get('job-edit/{id}', 'RecruiterDashboardController@job_edit');
        Route::get('job-delete/{id}', 'RecruiterDashboardController@job_delete');
        Route::post('update_job', 'RecruiterDashboardController@update_job');
        Route::post('create_job', 'RecruiterDashboardController@create_job');
        Route::get('job-preview/{id}', 'RecruiterDashboardController@job_preview');
        Route::get('job-billing/{id}', 'RecruiterDashboardController@job_billing');
        Route::get('job-post/pay/{id}', 'RecruiterDashboardController@pay_price_job');
        Route::get('create-job-with-credits/{id}', 'RecruiterDashboardController@create_job_with_credits');

        Route::get('thankyou/{id}', 'RecruiterDashboardController@thankyou');
        Route::post('apply_coupon', 'RecruiterDashboardController@apply_coupon');
        Route::get('buy-credits', 'RecruiterBuyCreditsController@index');
        Route::get('buy-credits/purchase/{id}', 'RecruiterBuyCreditsController@billing');
        Route::post('buy-package/{id}', 'RecruiterBuyCreditsController@buy_package');
        Route::get('package/thankyou/{id}', 'RecruiterBuyCreditsController@thankyou');

        Route::get('invoices', 'RecruiterInvoicesController@index');
        Route::get('/invoices/{id}', 'RecruiterInvoicesController@invoice_detail');


        //recruiter applicants section
        Route::get('applicants/{id}', 'RecruiterStatsController@applicants');

        //cv search
        Route::get('cv-search', 'RecruiterCvSearchController@index');
        Route::any('search/cvs', 'RecruiterCvSearchController@ajax_search');
        Route::post('purchase-cvs', 'RecruiterCvSearchController@buy_cv_package');
        Route::get('download_cvs/{seeker}/{id}', 'RecruiterCvSearchController@download_cvs');
    //purchased cv package

        Route::get('statistics', 'RecruiterStatsController@index');
        Route::get('job-stats/{id}', 'RecruiterStatsController@stats');

        //Recruiter Team Section
        Route::get('team', 'RecruiterTeamController@index');
        Route::get('team/add', 'RecruiterTeamController@add');
        Route::post('team/store', 'RecruiterTeamController@create');
        Route::get('team/delete/{id}', 'RecruiterTeamController@delete');

        //recriuiter job sttaus
        Route::get('job-status/{id}', 'RecruiterDashboardController@job_status');

        Route::get('contact', 'RecruiterContactController@index');
        Route::post('contact', 'RecruiterContactController@contact');

        //application
        Route::get('applicant/shortlist/{id}', 'RecruiterDashboardController@shortlist');

        //notifications
        Route::get('/notifications', 'RecruiterNotificationsController@index');

});

});

Route::get('instant', 'Front\PagesController@instant');





Route::group(['namespace' => 'Front'], function () {

//Route::namespace('Front')->group(function () {

    Route::get('/get-jobs-box-cookie', 'AjaxController@cookie');
    Route::get('all-countries', 'AjaxController@countries');

    Route::get('/job/affiliate/{id}/{cookie}', 'AffiliateController@index');

    Route::get('/industries', 'PagesController@industries');
    Route::get('/advertise-jobs', 'PagesController@advertise_jobs');
    Route::get('/cvdatabase', 'PagesController@cvdatabase');
    Route::get('/locations', 'PagesController@locations');
//    Route::get('/companies', 'PagesController@companies');

    Route::get('/publisher', 'PagesController@publisher');
    Route::post('/published', 'PagesController@published');
    Route::get('/our-networks', 'PagesController@networks');

    Route::get('/about-us', 'PagesController@aboutUs');
    Route::get('/privacy', 'PagesController@privacy');
    Route::get('/terms', 'PagesController@terms');


    Route::get('/', 'HomeController@index');
    Route::post('newsletter/save_email', 'HomeController@save_email');

    //display companies
    Route::get('companies', 'CompaniesController@index');
    Route::get('company/{id}', 'CompaniesController@detail');
    Route::post('company/save_rating', 'CompaniesController@save_rating');
    Route::get('company/url/{id}', 'CompaniesController@url');


//    pdf
    Route::get('test_pdf', 'HomeController@pdf');
    Route::get('contact', 'HomeController@contact');

    Route::get('create-job-alerts', 'JobAlertsController@index');
    Route::post('create-job-alerts', 'JobAlertsController@create');


    Route::get('email-preferences/view/{id}', 'JobAlertsController@view');
    Route::get('email-preferences/unsubscribe/{id}', 'JobAlertsController@unsubscribe');
    Route::get('email-preferences/ajax/unsubscribe/{id}', 'JobAlertsController@ajax_unsubscribe');
    Route::get('email-preferences/ajax/disable/{id}', 'JobAlertsController@disable');
    Route::get('manage-subscriptions/{id}', 'JobAlertsController@manage_subscriptions');
    Route::get('email-preferences/confirm/{id}', 'JobAlertsController@confirm');
    Route::post('alert/create_alert', 'JobAlertsController@create_alert');


    //Seeker Public Profile
    Route::get('seeker-profile/{username}', 'HomeController@seeker_profile');

    //seeker profile for recruiters
    Route::get('view-seeker/{id}', 'HomeController@seeker_profile_recruiter');
    Route::get('view-seeker-cv/{id}', 'HomeController@seeker_profile_recruiter_cv');


    //cities api to get in response
    Route::get('cities/{q}', 'AjaxController@cities');
    Route::get('contact', 'ContactController@index');
    Route::post('contact_request', 'ContactController@contact_request');


//    cron jobs
    Route::get('cron/should_run_once', 'CronJobsController@should_run_once');
    Route::get('cron/add_indexes', 'CronJobsController@add_indexes');
    Route::get('cron/total_salaries', 'CronJobsController@total_salaries');
    Route::get('cron/import_external_jobs', 'CronJobsController@import_jobs');
    Route::get('cron_seeker_upgrade_check', 'CronJobsController@seeker_upgrade_check');
    Route::get('cron/update_all_jobs_stats_admin', 'CronJobsController@update_all_jobs_stats_admin');
    Route::get('cron/update_all_counts', 'CronJobsController@update_all_counts');
    Route::get('cron/update_locations', 'CronJobsController@update_locations');
    Route::get('cron/expire_jobs', 'CronJobsController@expire_jobs');
    Route::get('cron/update_all_active_jobs_stats', 'CronJobsController@update_all_active_jobs_stats');
    Route::get('cron/udpate_city_lat_long', 'CronJobsController@udpate_city_lat_long');
    Route::get('cron/send_job_alerts', 'CronJobsController@send_job_alerts');
    Route::get('cron/expired_jobs', 'CronJobsController@expired_jobs');
    Route::get('cron/remove_company', 'CronJobsController@remove_company');
    Route::get('cron/send_job_alerts_test', 'CronJobsController@send_job_alerts_test');
    Route::get('cron/test_jobs', 'CronJobsController@test_jobs');
    Route::any('cron/sendinblue/remove_mail', 'CronJobsController@sendinblue_remove_mail');
    Route::any('cron/addColoumn', 'CronJobsController@addColoumn');
    Route::any('cron/updateOrders', 'CronJobsController@updateOrders');
    Route::any('cron/updateAll', 'CronJobsController@updateAll');

    Route::get('email_template_test', 'CronJobsController@email_template_test');
    Route::get('cron/email_test', 'CronJobsController@email_test');



    //show saved jobs from cookies
    Route::get('saved-jobs', 'JobsController@show_saved_jobs');
    Route::get('save-job', 'JobsController@save_job');
    Route::get('save-job/delete/{id}', 'JobsController@delete_saved_job');

    Route::get('search', 'JobsController@search')->name('search');
    Route::get('job/{id}', 'JobsController@detail');
    //test external jobs
    Route::get('check_jobs', 'JobsController@check_jobs');
//  apply on job
    Route::post('apply-on-job', 'JobsController@apply_job');

    //test route for email templates
    Route::get('email', 'HomeController@email_template');

    Route::get('sitemap.xml', 'SitemapController@sitemap');
    Route::get('sitemap', 'SitemapController@index');


//    Route::get('career-advice', 'HomeController@blogs');
    Route::get('career-advice', 'HomeController@career_advice');
    Route::any('career-advice/{slug}', 'HomeController@blog_detail');
    Route::get('category/{slug}', 'HomeController@blog_category');
    Route::get('author/{slug}', 'HomeController@blog_author');
    Route::get('blogger/blog_like/{id}/{field}', 'HomeController@blog_status')->name('blog_status');


    Route::get('jobs/{slug}', 'JobsController@jobs_seo');
    Route::get('jobs-at/{slug}', 'JobsController@jobs_at');


    Route::get('cron/update_seo', 'CronJobsController@seo_users');
    Route::get('cron/import_files', 'CronJobsController@import_files');

    Route::get('all/blogs/data', 'CronJobsController@blogs');

    Route::get('sales/unsub/{id}/{email}', 'SalesController@unsub');

});



Route::get('/ip', function () {

    echo ip();



});

Route::get('/logout', function () {
    Auth::guard('seeker')->logout();
    Auth::guard('recruiter')->logout();
    return redirect('/');
});
