<?php

namespace App\Traits;
use App\AdminSetting;
use App\Flag;
use App\Traits\Careerjet_API;
use Request;


Trait ExternalJobs {

    public function get_admin(){
        return AdminSetting::first();
    }


    public function ApiKey($api_key) {
        return json_decode($this->get_admin()->external_jobs_apis)->$api_key;
    }


    public function AllowFetch($name){
        $data = json_decode($this->get_admin()->external_jobs_apis);

        if($data->$name==1){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    public function WhatJobs($keyword='sales',$location='london',$jobtype='permanent',$page=1,$limit=20){

        if($this->AllowFetch('what_job_api')){

            $apikey =  $this->ApiKey('whatjobs_api_key');

            // Set parameters
            $parameters = array(
                'publisher' => $apikey, //2919
                'channel' => '',
                'user_ip' => Request::ip(),
                'user_agent' => Request::server('HTTP_USER_AGENT'),
                'keyword' => $keyword,
                'location' => $location,
                'limit' => $limit,
                'page' => $page,
                'sort' => 'relevance',
                'job_type' => $jobtype,
                'categories' => '',
            );

            $url = 'https://uk.whatjobs.com/api/v1/jobs.json' . '?' . http_build_query($parameters);
            return $this->getData($url);

        }else{
            return array('status' => 'fail', 'data' => 'API is closed from admin');
        }

    }


    public function ZipRecruiterJobs($keyword="", $location="",$radius=25,$pageNo=1,$perPage=20){

        if($this->AllowFetch('zip_recruiter_api')){
//            abxqv532gwwd6absyqani7xbqaqars8c
            $apikey =  $this->ApiKey('zip_recruiter_api_key');
//            dd($apikey);

            $data = array(
                'search' => $keyword,
                'location' => $location.','.$this->get_admin()->country_code,
                'radius_miles'=>$radius,
                'page' => $pageNo,
                'jobs_per_page'=> $perPage
            );

        $api_urls = "https://api.ziprecruiter.com/jobs/v1?&api_key=".$apikey."&" . http_build_query($data);

        return $this->getData($api_urls);

        }else{
            return array('status' => 'fail', 'data' => 'API is closed from admin');
        }


    }



    public function AdzunaJobs($pageNum=1, $t_records=50){

        if($this->AllowFetch('adzuna_api')) {

            $app_id = $this->ApiKey('adzuna_app_id');
            $app_key = $this->ApiKey('adzuna_app_key');
            $subDomain = getsubDomain();
            if($subDomain == 'uk'){
                $subDomain = 'gb';
            }

            $api_url = 'https://api.adzuna.com/v1/api/jobs/'.$subDomain.'/search/' . $pageNum . '?app_id='.$app_id
                .'&app_key='.$app_key.'&results_per_page='.$t_records;

            return $this->getData($api_url);

        }else{

            return array('status' => 'fail', 'data' => 'API is closed from admin');


        }

    }


    public function JobtomeJobs($page=20){

        if($this->AllowFetch('jobtome_api')) {

            $domain = request()->getHttpHost();
            $country = str_replace(".fratres.net", "", $domain);

            $pid = $this->ApiKey('jobtome_api_key');
//            $country = $this->get_admin()->country_code;
//            dd($country);
            $k = array("PHP","Sales", "Finance", "Programming", "Management", "Doctor", "Nurses", "Python", "Laravel", "Vue", "Business", "Engineer", "CTO");
            $k = $k[rand(0, count($k) - 1 )];

            $api_urls = "http://api.jobtome.com/v2.php?pid=".$pid."&k=".urlencode($k)."&ip=".$_SERVER["REMOTE_ADDR"]."&browser=".urlencode($_SERVER["HTTP_USER_AGENT"])."&output=json&country=".$country."&results=30&p=".$page;


            return $this->getData($api_urls);

        }else{

            return array('status' => 'fail', 'data' => 'API is closed from admin');


        }

    }

    public function CareerJetJobs($location_keyword='', $search_keyword='',$page=1){

//        6676d873f815c4ffb8bd34b9a061207b

        $domain = request()->getHttpHost();
        $flags = Flag::where("url", $domain)->first();


        if($this->AllowFetch('careerjet_api')) {

            $location = strtolower($flags->name);
            $affId = $this->ApiKey('careerjet_api_key');


            $location_keyword = "";
            if($domain == 'mr.fratres.net'){
                $location = 'Morocco';
            }
//            dd($location);

            $result = $this->CareerJetsearch(
                array(
                    'keywords' => $search_keyword,
                    'location' => $location." ".$location_keyword,
                    'page' => $page ,
                    'affid' => $affId,
                )
            );
//            echo $location;
//            dd( $result );
            return array('status' => 'success', 'data' => $result);

        }else{

            return array('status' => 'fail', 'data' => 'API is closed from admin');

        }


    }





    public function getData($url)
    {
        try {
            $response = file_get_contents($url);
            if (isset($http_response_header)) {
                if (!in_array('HTTP/1.1 200 OK', $http_response_header) &&
                    !in_array('HTTP/1.0 200 OK', $http_response_header)) {
                    return array('status' => 'fail', 'data' => 'API key is not valid');
                }
            }
            return array('status' => 'success', 'data' => json_decode($response));
        } catch (\Exception $ex) {
            return array('status' => 'fail', 'data' => 'API key is not valid 2');
        }
    }



    function CareerJetcall($fname , $args, $locale="en_GB")
    {
        $domain = request()->getHttpHost();
        $domain = str_replace(".fratres.net", "", $domain);

        switch ($domain){
            case 'pk':
                $locale = 'en_PK';
            break;
            case 'at':
                $locale = 'de_AT';
            break;
            case 'ch':
                $locale = 'de_CH';
            break;
            case 'de':
                $locale = 'de_DE';
            break;
            case 'ae':
                $locale = 'en_AE';
            break;
            case 'au':
                $locale = 'en_AU';
            break;
            case 'ca':
                $locale = 'en_CA';
            break;
            case 'cn':
                $locale = 'en_CN';
            break;
            case 'ie':
                $locale = 'en_IE';
            break;
            case 'in':
                $locale = 'en_IN';
            break;
            case 'my':
                $locale = 'en_MY';
            break;
            case 'nz':
                $locale = 'en_NZ';
            break;
            case 'ph':
                $locale = 'en_PH';
            break;
            case 'qa':
                $locale = 'en_QA';
            break;
            case 'sg':
                $locale = 'en_SG';
            break;
            case 'us':
                $locale = 'en_US';
            break;
            case 'za':
                $locale = 'en_ZA';
            break;
            case 'vn':
                $locale = 'en_VN';
            break;
            case 'cl':
                $locale = 'es_CL';
            break;
            case 'es':
                $locale = 'es_ES';
            break;
            case 'mx':
                $locale = 'es_MX';
            break;
            case 've':
                $locale = 'es_VE';
            break;
            case 'bl':
                $locale = 'fr_BE';
            break;
            case 'fr':
                $locale = 'fr_FR';
            break;
            case 'lu':
                $locale = 'fr_LU';
            break;
            case 'mr':
                $locale = 'fr_MA';
            break;
            case 'it':
                $locale = 'it_IT';
            break;
            case 'jp':
                $locale = 'ja_JP';
            break;
            case 'kr':
                $locale = 'ko_KR';
            break;
            case 'nl':
                $locale = 'nl_NL';
            break;
            case 'no':
                $locale = 'no_NO';
            break;
            case 'pl':
                $locale = 'pl_PL';
            break;
            case 'pt':
                $locale = 'pt_PT';
            break;
            case 'br':
                $locale = 'pt_BR';
            break;
            case 'ru':
                $locale = 'ru_RU';
            break;
            case 'ua':
                $locale = 'ru_UA';
            break;
            case 'se':
                $locale = 'sv_SE';
            break;
            case 'sk':
                $locale = 'sk_SK';
            break;
            case 'tr':
                $locale = 'tr_TR';
            break;
            default:
                $locale="en_GB";
            break;


        }

//        dd($locale);
//        dd( $domain );
        $url = 'http://public.api.careerjet.net/'.$fname.'?locale_code='.$locale;

        if (empty($args['affid'])) {
            return (object) array(
                'type' => 'ERROR',
                'error' => "Your Careerjet affiliate ID needs to be supplied. If you don't " .
                    "have one, open a free Careerjet partner account."
            );
        }

        foreach ($args as $key => $value) {
            $url .= '&'. $key . '='. urlencode($value);
        }

        if (empty($_SERVER['REMOTE_ADDR'])) {
            return (object) array(
                'type' => 'ERROR',
                'error' => 'not running within a http server'
            );
        }

        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $ip = $_SERVER["HTTP_CF_CONNECTING_IP"];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // For more info: http://en.wikipedia.org/wiki/X-Forwarded-For
            $ip = trim(array_shift(array_values(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']))));
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $url .= '&user_ip=' . $ip;
        $url .= '&user_agent=' . urlencode($_SERVER['HTTP_USER_AGENT']);

        // determine current page
        $current_page_url = '';
        if (!empty ($_SERVER["SERVER_NAME"]) && !empty ($_SERVER["REQUEST_URI"])) {
            $current_page_url = 'http';
            if (!empty ($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
                $current_page_url .= "s";
            }
            $current_page_url .= "://";

            if (!empty ($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
                $current_page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
            } else {
                $current_page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
            }
        }

        $header = "User-Agent: careerjet-api-client-v3.6-php-v" . phpversion();
        if ($current_page_url) {
            $header .= "\nReferer: " . $current_page_url;
        }

        $careerjet_api_context = stream_context_create(array(
            'http' => array('header' => $header)
        ));

        $response = file_get_contents($url, false, $careerjet_api_context);
        return json_decode($response);
    }

    function CareerJetsearch($args)
    {
        $result =  $this->CareerJetcall('search' , $args);
//        dd($result);
        if ($result->type == 'ERROR') {
            trigger_error( $result->error );
        }
        return $result;
    }

}



?>
