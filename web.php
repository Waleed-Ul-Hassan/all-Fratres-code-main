<?php

Config::set('dynamic_details.country', 'PK');

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


Route::get('/info', function () {


    $sessions = PragmaRX\Tracker::sessions(60 * 24);

    foreach ($sessions as $session)
    {
        var_dump( $session->user->email );

        var_dump( $session->device->kind . ' - ' . $session->device->platform );

        var_dump( $session->agent->browser . ' - ' . $session->agent->browser_version );

        var_dump( $session->geoIp->country_name );

        foreach ($session->session->log as $log)
        {
            var_dump( $log->path );
        }
    }

    die();


//    echo phpinfo();
});


Route::get('/clear', function () {
    echo Artisan::call('migrate');
//    echo Artisan::call("config:cache");
//    echo Artisan::call("config:clear");
//    echo Artisan::call("config:cache");
});

Route::get('/admi', function () {

    $p = new App\Admin;
    $p->name = "test";
    $p->type = "admin";
    $p->email = "test@tes.com";
    $p->password = \Hash::make("test");
    $p->save();


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
Route::get('admin/change-password', function () {
    return view('admin.auth.change-password');
});

Route::post('admin/login', 'Admin\AdminUserController@login');
Route::get('admin/logout', 'Admin\AdminUserController@logout');

//Route::get('blogs', 'HomeController@getBlogs');
//Route::get('blogs/{id}', 'HomeController@getBlogss');
//Route::post('blogs-hide/{id}', 'HomeController@hideBlogss');
//Route::post('blogs-show/{id}', 'HomeController@showBlogss');
//Route::post('blogs-delete/{id}', 'HomeController@delete');
//Route::post('create/user', 'HomeController@createUser');



Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::get('/home', 'AdminHomeController@index');

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
    Route::post('/delete-seo/{id}', 'AdminSeoController@deleteSeo');

    Route::get('/contact-us', 'AdminContactUsController@index');
    Route::post('/save-contact-us', 'AdminContactUsController@saveContactUs');
    Route::post('/delete-contact-us/{id}', 'AdminContactUsController@deleteSkills');

//        admin newsletters
    Route::get('/newsletter', 'AdminNewslettersController@index');
    Route::get('/newsletter/delete/{id}', 'AdminNewslettersController@delete');
//        end admin newsletters

    Route::get('/analytics', 'AdminAnalyticsController@index');
    Route::get('/test_analytics', 'AdminAnalyticsController@test_analytics');

    //Seeker
    Route::get('/seekers', 'AdminSeekerController@index');
    Route::get('detail-seekers/{id}', 'AdminSeekerController@detailSeekers');
    Route::post('block-seekers/{id}', 'AdminSeekerController@blockSeekers');


    Route::get('/recruiter', 'AdminRecuiterController@index');
    Route::get('detail-recruiter/{id}', 'AdminRecuiterController@detailRecuiter');
    Route::post('block-recruiter/{id}', 'AdminRecuiterController@blockSeekers');


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



    Route::get('/blogs', 'AdminBlogController@blogs');
    Route::get('/blogs/{id}', 'AdminBlogController@singleblogs');
    Route::get('/blogs/users', 'AdminBlogController@users');


    Route::get('/job-alerts', 'AdminJobAlertsController@index');




});


Route::group(['namespace' => 'Seeker', 'prefix' => 'seeker','middleware' => 'isOnlineSeeker'], function () {

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

    //download CVS
    Route::get('/cv-maker/cv-download/{id}', 'SeekerCvMakerController@cv_download');



    //upgrade seeker profile
    Route::get('/upgrade-profile', 'SeekerUpgradeProfileController@index');
    Route::post('/upgrade-profile', 'SeekerUpgradeProfileController@upgrade_profile');
    Route::get('/profile/thankyou/{id}', 'SeekerUpgradeProfileController@thankyou');





});

Route::group(['namespace' => 'Recruiter', 'prefix' => 'recruiter','middleware' => 'isOnlineRecruiter'], function () {

        Route::get('/login', 'RecruiterAuthController@login');
        Route::post('/login', 'RecruiterAuthController@login_post');
        Route::get('/register', 'RecruiterAuthController@register');
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

        Route::get('dashboard', 'RecruiterDashboardController@index');
        Route::get('manage-jobs', 'RecruiterDashboardController@manage_jobs');
        Route::get('profile', 'RecruiterDashboardController@profile');
        Route::post('update', 'RecruiterDashboardController@update');
        Route::get('billing', 'RecruiterDashboardController@billing');
        Route::post('update-billing', 'RecruiterDashboardController@update_billing');

        Route::get('job_post', 'RecruiterDashboardController@job_post');
        Route::get('job-edit/{id}', 'RecruiterDashboardController@job_edit');
        Route::get('job-delete/{id}', 'RecruiterDashboardController@job_delete');
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

        //recruiter applicants section
        Route::get('applicants/{id}', 'RecruiterStatsController@applicants');

    //cv search
    Route::get('cv-search', 'RecruiterCvSearchController@index');
    Route::post('purchase-cvs', 'RecruiterCvSearchController@buy_cv_package');
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

    //application
    Route::get('applicant/shortlist/{id}', 'RecruiterDashboardController@shortlist');

    //recruiter contact
    Route::get('contact', 'RecruiterContactController@index');
    Route::post('contact', 'RecruiterContactController@contact');




});

Route::namespace('Front')->group(function () {


    Route::get('/', 'HomeController@index');
    Route::get('search', 'HomeController@search');
    Route::post('newsletter/save_email', 'HomeController@save_email');
    Route::get('job/{id}', 'HomeController@detail');

//    apply on job
    Route::post('apply-on-job', 'HomeController@apply_job');

//    pdf
    Route::get('test_pdf', 'HomeController@pdf');

    Route::get('create-job-alerts', 'JobAlertsController@index');

    Route::post('create-job-alerts', 'JobAlertsController@create');


    Route::get('email-preferences/view/{id}', 'JobAlertsController@view');
    Route::get('email-preferences/unsubscribe/{id}', 'JobAlertsController@unsubscribe');
    Route::get('email-preferences/confirm/{id}', 'JobAlertsController@confirm');

    //show saved jobs from cookies
    Route::get('saved-jobs', 'HomeController@show_saved_jobs');
    Route::get('save-job', 'HomeController@save_job');
    Route::get('save-job/delete/{id}', 'HomeController@delete_saved_job');


    //test route for email templates
    Route::get('email', 'HomeController@email_template');

    //test external jobs
    Route::get('check_jobs', 'HomeController@check_jobs');

    //Seeker Public Profile
    Route::get('seeker-profile/{username}', 'HomeController@seeker_profile');

    //seeker profile for recruiters
    Route::get('view-seeker/{id}', 'HomeController@seeker_profile_recruiter');
//    view uploaded cv of seeker
    Route::get('view-seeker-cv/{id}', 'HomeController@seeker_profile_recruiter_cv');



});


Route::get('/logout', function () {
    Auth::guard('seeker')->logout();
    Auth::guard('recruiter')->logout();
    return redirect('/');
});
