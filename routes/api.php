<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('seeker/login', 'Api\Mobile\Seeker\Auth\SeekerAuthController@login');
Route::post('seeker/register_one', 'Api\Mobile\Seeker\Auth\SeekerAuthController@register_one');
Route::post('seeker/register_create', 'Api\Mobile\Seeker\Auth\SeekerAuthController@register_create');
Route::post('seeker/forget-password', 'Api\Mobile\Seeker\Auth\SeekerAuthController@forgetPasswords');

Route::post('recruiter/login', 'Api\Mobile\Recruiter\Auth\RecruiterAuthController@login');
Route::post('recruiter/signup', 'Api\Mobile\Recruiter\Auth\RecruiterAuthController@signup');
Route::post('recruiter/create', 'Api\Mobile\Recruiter\Auth\RecruiterAuthController@create');
Route::post('recruiter/forgetPasswords', 'Api\Mobile\Recruiter\Auth\RecruiterAuthController@forgetPasswords');
//Route::post('seeker/register_create', 'Api\Mobile\Seeker\Auth\SeekerAuthController@register_create');
//Route::post('seeker/forget-password', 'Api\Mobile\Seeker\Auth\SeekerAuthController@forgetPasswords');




Route::get('cities', 'Api\Mobile\PublicLib\AllController@cities');
Route::get('countries', 'Api\Mobile\PublicLib\AllController@countries');
Route::get('industries', 'Api\Mobile\PublicLib\AllController@industries');
Route::post('search', 'Api\Mobile\Jobs\JobsController@search');
Route::post('job-detail', 'Api\Mobile\Jobs\JobsController@detail');
Route::post('apply_job', 'Api\Mobile\Jobs\JobsController@apply_job');
Route::get('total_jobsm', 'Api\Mobile\PublicLib\AllController@total_jobs');

Route::post('save_job', 'Api\Mobile\Jobs\JobsController@save_job');
Route::post('show_saved_jobs', 'Api\Mobile\Jobs\JobsController@show_saved_jobs');

Route::get('alerts', 'Api\Mobile\PublicLib\JobAlertsController@index');
Route::post('create_alert', 'Api\Mobile\PublicLib\JobAlertsController@create_alert');
Route::post('update_alert', 'Api\Mobile\PublicLib\JobAlertsController@update_alert');


Route::group(['namespace' => 'Api\Mobile\Seeker', 'prefix' => 'seeker','middleware' => 'validateMobile'], function () {

    Route::post('alerts', 'Alerts\SeekerAlertsController@index');
    Route::post('alerts/delete', 'Alerts\SeekerAlertsController@delete');

    Route::post('save_summary', 'CvMaker\SeekerCvMakerController@save_summary');
    Route::post('updatePassword', 'Auth\SeekerProfileController@updatePassword');
    Route::post('account_update', 'Auth\SeekerProfileController@account_update');
    Route::post('remove_cv', 'Auth\SeekerProfileController@remove_cv');
    Route::post('change_avatar', 'Auth\SeekerProfileController@change_avatar');

    Route::post('applied_jobs', 'Dashboard\SeekerDashboardController@appliedJobs');

    Route::post('invoices', 'Invoice\SeekerInvoiceController@invoices');
    Route::post('upgrade_profile', 'Invoice\SeekerInvoiceController@upgrade_profile');

    Route::post('cvmaker', 'CvMaker\SeekerCvMakerController@index');
    Route::post('save_experience', 'CvMaker\SeekerCvMakerController@save_experience');
    Route::post('get_experience', 'CvMaker\SeekerCvMakerController@get_experience');
    Route::post('delete_experience', 'CvMaker\SeekerCvMakerController@delete_experience');
    Route::post('save_project', 'CvMaker\SeekerCvMakerController@save_project');
    Route::post('get_project', 'CvMaker\SeekerCvMakerController@get_project');
    Route::post('delete_project', 'CvMaker\SeekerCvMakerController@delete_project');
    Route::post('save_certification', 'CvMaker\SeekerCvMakerController@save_certification');
    Route::post('get_certification', 'CvMaker\SeekerCvMakerController@get_certification');
    Route::post('delete_certification', 'CvMaker\SeekerCvMakerController@delete_certification');
    Route::post('save_skills', 'CvMaker\SeekerCvMakerController@save_skills');
    Route::post('save_hobbies', 'CvMaker\SeekerCvMakerController@save_hobbies');
    Route::post('save_language', 'CvMaker\SeekerCvMakerController@save_language');
    Route::post('save_reference', 'CvMaker\SeekerCvMakerController@save_reference');
    Route::post('delete_reference', 'CvMaker\SeekerCvMakerController@delete_reference');
    Route::post('seeking_job', 'CvMaker\SeekerCvMakerController@seeking_job');
    Route::post('save_education', 'CvMaker\SeekerCvMakerController@save_education');
    Route::post('get_education', 'CvMaker\SeekerCvMakerController@get_education');
    Route::post('delete_education', 'CvMaker\SeekerCvMakerController@delete_education');
    Route::post('check_availability', 'CvMaker\SeekerCvMakerController@check_availability');
    Route::post('cv_download', 'CvMaker\SeekerCvMakerController@cv_download');


});


Route::group(['namespace' => 'Api\Mobile\Recruiter', 'prefix' => 'recruiter','middleware' => 'ValidateMobileRecruiter'], function () {

    Route::post('dashboard', 'Dashboard\RecruiterDashboardController@index');
    Route::post('manage_jobs', 'Dashboard\RecruiterJobsController@manage_jobs');

    Route::post('update_password', 'Profile\RecruiterProfileController@update');
    Route::post('update_logo', 'Profile\RecruiterProfileController@update');

    Route::post('create_job', 'Dashboard\RecruiterJobsController@create_job');
    Route::post('update_job', 'Dashboard\RecruiterJobsController@update_job');
    Route::post('create_job_with_credits', 'Dashboard\RecruiterJobsController@create_job_with_credits');
    Route::post('apply_coupon', 'Dashboard\RecruiterJobsController@apply_coupon');
    Route::post('job_delete', 'Dashboard\RecruiterJobsController@job_delete');
    Route::post('job_status', 'Dashboard\RecruiterJobsController@job_status');
    Route::post('shortlist', 'Dashboard\RecruiterJobsController@shortlist');

    Route::post('invoices', 'Invoice\RecruiterInvoiceController@index');
    Route::post('invoice_detail', 'Invoice\RecruiterInvoiceController@invoice_detail');

    Route::post('packages', 'Credits\RecruiterCreditController@index');
    Route::post('buy_package', 'Credits\RecruiterCreditController@buy_package');
    Route::post('thankyou', 'Credits\RecruiterCreditController@thankyou');

    Route::post('contact', 'Contact\RecruiterContactController@index');
    Route::post('contact/save', 'Contact\RecruiterContactController@contact');


    Route::post('cv_search', 'CvSearch\RecruiterCvSearchController@index');
    Route::post('buy_cv_package', 'CvSearch\RecruiterCvSearchController@buy_cv_package');
    Route::post('download_cvs', 'CvSearch\RecruiterCvSearchController@download_cvs');

    Route::post('update_billing', 'Profile\RecruiterProfileController@update_billing');

    Route::post('notifications', 'Dashboard\RecruiterNotificationsController@index');

    Route::post('stats', 'Dashboard\RecruiterStatsController@index');
    Route::post('stats/applicants', 'Dashboard\RecruiterStatsController@applicants');
    Route::post('stats/job', 'Dashboard\RecruiterStatsController@stats');




});




Route::get('total_jobs', 'Api\ApiController@index');
Route::get('app-colors', 'Api\StatController@app_colors');

Route::get('medicalsjobs', 'Api\ApiController@medicalsjobs');
Route::get('update_products/medicalsjobs/{id}', 'Api\ApiController@update_products1');

Route::get('retailsjobs', 'Api\ApiController@retailsjobs');
Route::get('update_products/retailsjobs/{id}', 'Api\ApiController@update_products2');

Route::get('cityJobs', 'Api\ApiController@cityJobs');
Route::get('update_products/cityJobs/{id}', 'Api\ApiController@update_products3');

Route::get('aeCityJobs', 'Api\ApiController@aeCityJobs');
Route::get('update_products/aeCityJobs/{id}', 'Api\ApiController@update_products4');

Route::get('usCityJobs', 'Api\ApiController@usCityJobs');
Route::get('update_products/usCityJobs/{id}', 'Api\ApiController@update_products5');

Route::get('sgCityJobs', 'Api\ApiController@sgCityJobs');
Route::get('update_products/sgCityJobs/{id}', 'Api\ApiController@update_products6');

Route::get('wowJobs', 'Api\ApiController@wowJobs');
Route::get('update_products/wowJobs/{id}', 'Api\ApiController@update_products7');

Route::get('pkWowJobs', 'Api\ApiController@pkWowJobs');
Route::get('update_products/pkWowJobs/{id}', 'Api\ApiController@update_products8');


Route::get('security_jobs', 'Api\ApiController@security_jobs');
Route::get('update_products/security_jobs/{id}', 'Api\ApiController@update_products9');


Route::get('jobs', 'Api\ApiController@jobs');
Route::get('detail/{cookie}/{id}/{cid}', 'Api\ApiController@detail');
Route::post('updateStats', 'Api\ApiController@updateStats');

Route::get('getUser', 'Api\StatController@index');

Route::any('getStats', 'Api\StatController@getStats');

Route::post('createEmailAlertsFromMedicalJobs', 'Api\ApiController@createEmailAlertsFromMedicalJobs');
Route::post('createEmailAlertsFromCityJobs', 'Api\ApiController@createEmailAlertsFromCityJobs');
Route::post('createEmailAlertsFromaeCityJobsJobs', 'Api\ApiController@createEmailAlertsFromaeCityJobsJobs');
Route::post('createEmailAlertsFromsgCityJobsJobs', 'Api\ApiController@createEmailAlertsFromsgCityJobsJobs');
Route::post('createEmailAlertsFromusCityJobsJobs', 'Api\ApiController@createEmailAlertsFromusCityJobsJobs');
Route::post('createEmailAlertsFromwowJobsJobs', 'Api\ApiController@createEmailAlertsFromwowJobsJobs');
Route::post('createEmailAlertsFrompkWowJobsJobs', 'Api\ApiController@createEmailAlertsFrompkWowJobsJobs');
Route::post('createEmailAlertsFromretailJobs', 'Api\ApiController@createEmailAlertsFromretailJobs');
Route::post('createEmailAlertsFromSecurityJobs', 'Api\ApiController@createEmailAlertsFromSecurityJobs');

Route::get('/my-ip', function (Request $request) {
//    try{
//        return $_SERVER['REMOTE_ADDR'];
//    }catch(Exception $exception){
//        dd( $exception->getMessage() );
//    }
    return $_SERVER['REMOTE_ADDR'];
//    return $request->ip();
});


Route::post('getInfo', function (Request $request) {

    $sites = array("is_bounce" => true, "url" => "https://google.com","referrer" => "", "timer" => 20, "country_list" => array("PK", "UK"),
                "sites" => "https://google.com", "actual_url" => "https://google.com", "country_code" => "PK", "is_mobile" => false, "pk" => 1122, "tabid" => 12);

    $response = new stdClass();
    $response->delete_url = "https://www.sultan-ul-ashiqeen.com/personality-sultan-ul-ashiqeen-light-quran-hadith/";
    $response->payload_id = null;
    $response->site_index = 1122;
    $response->status = "ok";
    $response->sites = [$sites];
//    $response->is_bounce = true;

//    $response->url = "";
//    $response->referrer = "https://www.sultan-ul-ashiqeen.com/personality-sultan-ul-ashiqeen-light-quran-hadith/";
//    $response->timer = 20;
//    $response->country_list = ["PK", "UK"];
//    $response->sites = ["https://www.sultan-ul-ashiqeen.com/personality-sultan-ul-ashiqeen-light-quran-hadith/", "https://www.sultan-ul-ashiqeen.com/personality-sultan-ul-ashiqeen-light-quran-hadith/"];
//    $response->actual_url = "https://www.sultan-ul-ashiqeen.com/personality-sultan-ul-ashiqeen-light-quran-hadith/";
//    $response->country_code = "PK";
//    $response->is_mobile = false;
//    $response->pk = 1122;
//    $response->tabid = 12;


    return json_encode($response);
});





