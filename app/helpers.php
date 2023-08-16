<?php

use App\Job;
use App\Recruiter;
use Illuminate\Support\Facades\Auth;

if (!function_exists('percentage_diff')) {
    function percentage_diff($newval=0,$original_val=0) {

        $up = ' <small><i class="fas fa-arrow-up relate"></i></small>';
        $percent = ' <sup class="font-12 sup">%</sup>';
        $down = ' <small><i class="fas fa-arrow-down relate"></i></small>';

        if( $newval > $original_val ){

           $increase = $newval - $original_val;
           if($original_val==0){
               $original_val = 1;
           }
           $increase = ($increase / $original_val) * 100;
           $increase = round($increase);
           return $increase.$percent.$up;


        }else{

            $decrease = $original_val - $newval;
            if($original_val==0){
                $original_val = 1;
            }
            $decrease = ($decrease / $original_val) * 100;
            $decrease = round($decrease);
            return $decrease.$percent.$down;

        }

    }
}



if (!function_exists('hasWord')) {
    function hasWord($needle = 'to', $haystack = 'I go to school') {
        if (strpos($haystack, $needle) !== false) return true;
        else return false;
    }
}

if (!function_exists('nice_number')) {
    function nice_number($n) {
        // first strip any formatting;
        $n = (0+str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n > 1000000000000) return round(($n/1000000000000), 2).' trillion';
        elseif ($n > 1000000000) return round(($n/1000000000), 2).' billion';
        elseif ($n > 1000000) return round(($n/1000000), 2).' million';
        elseif ($n > 1000) return round(($n/1000), 2).'k';

        return number_format($n);
    }
}


if (!function_exists('email_info')) {
    function email_info($subject, $to, $mesg) {
        $domain = getsubDomain();

       return "{  \n   \"sender\":{  \n      \"name\":\"Fratres\",\n      \"email\":\"info@fratres.net\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"$to\",\n         \"name\":\"John Doe\"\n      }\n   ],\n   \"subject\":\"$subject\",\n   \"htmlContent\": ".json_encode($mesg).", \"tags\":[\"$domain\"] }";

    }
}

if (!function_exists('sales_email_info')) {
    function sales_email_info($subject, $to, $mesg, $tags) {

        $domain = getsubDomain();
        $domain = $domain.'-'.$tags;

       return "{  \n   \"sender\":{  \n      \"name\":\"Fratres\",\n      \"email\":\"info@fratres.net\"\n   },\n   \"to\":[  \n      {  \n         \"email\":\"$to\",\n         \"name\":\"John Doe\"\n      }\n   ],\n   \"subject\":\"$subject\",\n   \"htmlContent\": ".json_encode($mesg).", \"tags\":[\"$domain\"] }";

    }
}



if (!function_exists('convert')) {
    function convert($size)
    {
        $unit=array('b','kb','mb','gb','tb','pb');
        return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    }
}




if (!function_exists('mail_sendinblue')) {
    function mail_sendinblue($msg) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.sendinblue.com/v3/smtp/email');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'Api-Key: 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';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return $result;

    }
}







if (!function_exists('pre')) {

    function pre($array,$die=0)
    {
        echo '<pre>';
        print_r($array);
        if($die==1){
            die();
        }
    }
}



if (!function_exists('getDomainRoot')) {

    function getDomainRoot()
    {
        $domain = request()->getHost();
        if($domain == 'fratres.local'){
            return 'local';
        }else{
            $domain = str_replace(".fratres.net", "", $domain);
            return '';
        }
    }
}

if (!function_exists('getsubDomain')) {

    function getsubDomain()
    {
        $domain = request()->getHost();
        if($domain == '127.0.0.1'){
            return 'local';

        }
        if($domain == 'fratres.local'){
            return 'local';
        }else{
            $domain = str_replace(".fratres.net", "", $domain);
            return $domain;
        }
    }
}





if (!function_exists('getActive')) {

    function getActive($name,$value,$active="active")
    {
        if( isset($_GET[$name]) && $_GET[$name] == $value ){
            return $active;
        }
    }
}

if (!function_exists('if_isset')) {

    function if_isset($array,$index)
    {
        if( isset($array[$index])) {
            return $array[$index];
        }else{
            return 0;
        }
    }
}

if (!function_exists('mousedown')) {

    function mousedown($job)
    {
        if( $job->job_website == 'jobto_me' ) {
            return $job->addition_params;
        }
        if( $job->job_website == 'what_jobs' ) {
            return $job->addition_params;
        }

    }
}



if (!function_exists('search_urls')) {

    function search_urls($index,$value,$request)
    {
        $entries = array();
        foreach ($request->except("page") as $key => $part) {
            if( $key != $index ){
                $entries[$key] =  $part;
            }
        }
        $entries[$index] =  $value;

      return array_filter($entries,'strlen' );

    }
}




if (!function_exists('showYears')) {

    function showYears($months)
    {

        if( $months < 12 ){
            return $months . " Months";
        }else{
            $month = $months / 12;
            return $years = number_format($month,2) . " Years";
//            return str_replace(".","",$fraction) . " Years";

        }
    }
}



if (!function_exists('recruiter_logged')) {

    function recruiter_logged($field)
    {
        if(Auth::guard('recruiter')->check()){

            return Auth::guard('recruiter')->user()->$field;

        }
    }
}



if (!function_exists('recruiter_logged_parent')) {

    function recruiter_logged_parent($field)
    {

        $team = Recruiter::find(Auth::guard('recruiter')->user()->parent);
        return $team->$field;

    }
}

if (!function_exists('ip_address')) {

    function ip_address()
    {
        $ipAddress = '';
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ('' !== trim($_SERVER['HTTP_X_FORWARDED_FOR']))) {
                $ipAddress = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
        } else {
            if (isset($_SERVER['REMOTE_ADDR']) && ('' !== trim($_SERVER['REMOTE_ADDR']))) {
                $ipAddress = trim($_SERVER['REMOTE_ADDR']);
            }
        }

        return $ipAddress;

    }
}

if (!function_exists('getBrowser')) {
    function getBrowser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";
        $ub = "";
        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/OPR/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
    }
}


if (!function_exists('getVisitor')) {

    function getVisitor($ipAddress)
    {
        if($ipAddress != ''){
            return get_web_page('http://ip-api.com/json/'.$ipAddress);
        }
    }
}

if (!function_exists('displayVisitor')) {

    function displayVisitor($ipAddress)
    {
        if($ipAddress != ''){
            $ipAddress = json_decode($ipAddress);
            https://www.google.com/maps/place/Bahawalpur,+Punjab+63100,+Pakistan/@29.394867,71.6627184,13z
            $address = $ipAddress->city.',+'.$ipAddress->regionName.'+'.$ipAddress->zip.',+'.$ipAddress->country.'/@'.$ipAddress->lat.','.$ipAddress->lon.',13z';
            return '<a href="https://www.google.com/maps/place/'.$address.'" target="_blank">'.$ipAddress->city.' '.$ipAddress->country.'</a>';

        }
    }
}



if (!function_exists('getVisitorDefault')) {

    function getVisitorDefault()
    {
        $info = get_web_page('http://ip-api.com/json/'.ip_address());
        if($info && isset($info['content'])){
            return $info['content'];
//            dd($info);
        }
    }
}




if (!function_exists('get_web_page')) {

    function get_web_page( $url, $cookiesIn = '' ){
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => true,     //return headers in addition to content
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLINFO_HEADER_OUT    => true,
            CURLOPT_SSL_VERIFYPEER => true,     // Validate SSL Cert
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_COOKIE         => $cookiesIn
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $rough_content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header_content = substr($rough_content, 0, $header['header_size']);
        $body_content = trim(str_replace($header_content, '', $rough_content));
        $pattern = "#Set-Cookie:\\s+(?<cookie>[^=]+=[^;]+)#m";
        preg_match_all($pattern, $header_content, $matches);
        $cookiesOut = implode("; ", $matches['cookie']);

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['headers']  = $header_content;
        $header['content'] = $body_content;
        $header['cookies'] = $cookiesOut;
        return $header;
    }

}



if (!function_exists('exturl')) {

    function exturl($url)
    {
        $ur = substr($url, 0, 3);
        if($ur == 'www'){
            return '//'.$url;
        }
        return $url;
    }
}

if (!function_exists('old_data')) {

    function old_data($field,$mode,$data="",$id="")
    {
        if($mode=='add'){
            return old($field);
        }else{
//            $job = Job::find($id);
            return $data->$field;
        }
    }
}

if (!function_exists('old_data_skills')) {

    function old_data_skills($field, $mode, $data)
    {
        if($mode=='add'){
            return old($field);
        }else{
//            return old($field);
            return $data->skills->pluck('id')->toArray();
        }
    }
}







if (!function_exists('billing_details')) {

    function billing_details($field)
    {
        $loggedIn = recruiter_logged('billing_details');
        $loggedIn = json_decode($loggedIn);
        if(isset($loggedIn->billing_details->$field)){
            return $loggedIn->billing_details->$field;
        }
    }
}





if (!function_exists('verify_email')) {



        function verify_email($to, $subject, $reply, $from = "", $from_name = "")
        {

            $headers = "From: Fratres <noreply@fratres.net>" . "\r\n";

            $headers .= "Reply-To: noreply@fratres.net\r\n";
//            $headers .= "Return-Path: noreply@fratres.net\r\n";

            $headers .= "Organization: Sender Organization\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $headers .= "X-Priority: 3\r\n";
            $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;



//            $message = '<html><body>';
//            $message .= nl2br($reply);
            $message = $reply;
//            $message .= "</body></html>";

//            dd($message);
            sendMail($to, $subject, $message, $headers, "noreply@fratres.net", $from_name);

        }




}

if (!function_exists('sendMail')) {
    function sendMail($to, $subject, $message, $headers, $from = "", $from_name = "", $to_name = "")
    {
        mail($to, $subject, $message, $headers);
    }

}
if (!function_exists('swal_alert_message')) {

    function swal_alert_message($message, $text, $button, $alert_type)
    {
        return array(
            'message' => $message,
            'text' => $text,
            'button' => $button,
            'timer' => 1500,
            'alert-type' => $alert_type
        );
    }
}

if (!function_exists('swal_alert_message_error')) {

    function swal_alert_message_error($message="Something Unexpected Happened", $text="Please Contact Support", $button="Okay", $alert_type="error")
    {
        return array(
            'message' => $message,
            'text' => $text,
            'button' => $button,
            'alert-type' => $alert_type
        );
    }
}




if (!function_exists('return_zero')) {

    function return_zero($request, $validation, $validation_two=1)
    {
        if($request==null OR $validation == null OR $validation_two == null){
            return 0;
        }else{
            return $request;
        }
    }
}

if (!function_exists('seeker_api_array')) {

    function seeker_api_array($string)
    {
        $string = str_replace('[', '', $string);
        $string = str_replace(']', '', $string);
        $string = explode(',', $string);
        return $string;
    }
}

if (!function_exists('seeker_api_arraytt')) {

    function seeker_api_arraytt($string)
    {
        $string = str_replace('[', '', $string);
        $string = str_replace(']', '', $string);
//        $string = explode(',', $string);
        return $string;
    }
}




if (!function_exists('clean')) {

    function clean($string) {


        $string = str_slug($string); // Replaces all spaces with hyphens.
        $string = str_replace('-', ' ', $string); // Replaces all spaces with hyphens.
        $string = ucwords($string);

        return $string;
    }
}

if (!function_exists('ip')) {

    function ip()
    {
        $ipAddress = '';
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ('' !== trim($_SERVER['HTTP_X_FORWARDED_FOR']))) {
            $ipAddress = trim($_SERVER['HTTP_X_FORWARDED_FOR']);
        } else {
            if (isset($_SERVER['REMOTE_ADDR']) && ('' !== trim($_SERVER['REMOTE_ADDR']))) {
                $ipAddress = trim($_SERVER['REMOTE_ADDR']);
            }
        }
        return $ipAddress;
    }
}



if (!function_exists('make_active')) {

    function make_active($url, $class)
    {
        if($url == Request()->path()){
            if($class=='open'){
                return 'menu-open';
            }
            if($class=='active'){
                return 'active';
            }

        }
    }
}


if (!function_exists('charts_colors')) {

    function charts_colors()
    {
        return "'#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#007bff','#f012be','#6610f2','#d81b60','#001f3f'";
    }
}


if (!function_exists('show_phone')) {

    function show_phone($json, $field)
    {
        $data = json_decode($json);
        if(isset($data->$field)){
            return $data->$field;
        }
    }
}

if (!function_exists('seeker_logged')) {

    function seeker_logged($field)
    {
        if(Auth::guard('seeker')->check()){
            return Auth::guard('seeker')->user()->$field;
        }
    }
}

if (!function_exists('array_fields')) {

    function array_fields($field,$key)
    {
        if(Auth::guard('seeker')->check()){
            $seeker = explode(",",Auth::guard('seeker')->user()->$field);
            if(in_array($key, $seeker)){
                return $key;
            }
        }
    }
}

if (!function_exists('all_flags')) {

    function all_flags()
    {
        $data = \App\Flag::all();
        return $data;
    }
}

if (!function_exists('return_logo')) {

    function return_logo($website)
    {
        switch ($website){
            case 'jobto_me';
                return 'jobtome.jpg';
            break;
            case 'zip_recruiter';
                return 'ziprecruiter.gif';
            break;
            case 'adzuna_jobs';
                return 'adzuna.png';
            break;
            case 'career_jet';
                return 'careerjet.png';
            break;
            case 'what_jobs';
                return 'whatjobs.png';
            break;



        }
    }
}





if (!function_exists('countries_subdomains_flags')) {

    function countries_subdomains_flags()
    {
        $data[0] = array("name"=>"Australia","flag"=>"au.png","url"=>"au.fratres.net");
        $data[1] = array("name"=>"Bangladesh","flag"=>"bd.png","url"=>"bd.fratres.net");
        $data[2] = array("name"=>"Bulgaria","flag"=>"bg.png","url"=>"bg.fratres.net");
        $data[3] = array("name"=>"China","flag"=>"cn.png","url"=>"cn.fratres.net");
        $data[4] = array("name"=>"France","flag"=>"fr.png","url"=>"fr.fratres.net");
        $data[5] = array("name"=>"Ireland","flag"=>"ie.jpg","url"=>"ie.fratres.net");
        $data[6] = array("name"=>"Korea","flag"=>"kr.svg","url"=>"kr.fratres.net");
        $data[7] = array("name"=>"Luxembourg","flag"=>"lu.png","url"=>"lu.fratres.net");
        $data[8] = array("name"=>"Morroco","flag"=>"mr.png","url"=>"mr.fratres.net");
        $data[9] = array("name"=>"Norway","flag"=>"no.png","url"=>"no.fratres.net");
        $data[10] = array("name"=>"Poland","flag"=>"pl.jpg","url"=>"pl.fratres.net");
        $data[11] = array("name"=>"Romania","flag"=>"ro.png","url"=>"ro.fratres.net");
        $data[12] = array("name"=>"Singapore","flag"=>"sg.png","url"=>"sg.fratres.net");
        $data[12] = array("name"=>"Spain","flag"=>"es.png","url"=>"es.fratres.net");
        $data[13] = array("name"=>"Switzerland","flag"=>"ch.jpg","url"=>"ch.fratres.net");
        $data[14] = array("name"=>"UAE","flag"=>"ae.png","url"=>"ae.fratres.net");
        $data[15] = array("name"=>"Venezuela","flag"=>"ve.jpg","url"=>"ve.fratres.net");
        $data[16] = array("name"=>"Austria","flag"=>"at.svg","url"=>"at.fratres.net");
        $data[17] = array("name"=>"Belgium","flag"=>"bl.png","url"=>"bl.fratres.net");
        $data[18] = array("name"=>"Canada","flag"=>"ca.png","url"=>"ca.fratres.net");
        $data[19] = array("name"=>"Colombia","flag"=>"co.png","url"=>"co.fratres.net");
        $data[20] = array("name"=>"Germany","flag"=>"de.png","url"=>"de.fratres.net");
        $data[21] = array("name"=>"Italy","flag"=>"it.png","url"=>"it.fratres.net");
        $data[22] = array("name"=>"Kuwait","flag"=>"kw.png","url"=>"kw.fratres.net");
        $data[23] = array("name"=>"Malaysia","flag"=>"my.png","url"=>"my.fratres.net");
        $data[24] = array("name"=>"New Zealand","flag"=>"nz.jpg","url"=>"nz.fratres.net");
        $data[25] = array("name"=>"Pakistan","flag"=>"pk.png","url"=>"pk.fratres.net");
        $data[26] = array("name"=>"Portugal","flag"=>"prt.png","url"=>"prt.fratres.net");
        $data[27] = array("name"=>"Russia","flag"=>"ru.svg","url"=>"ru.fratres.net");
        $data[28] = array("name"=>"Slovakia","flag"=>"sk.png","url"=>"sk.fratres.net");
        $data[29] = array("name"=>"Sri Lanka","flag"=>"lk.svg","url"=>"lk.fratres.net");
        $data[30] = array("name"=>"Thailand","flag"=>"th.svg","url"=>"th.fratres.net");
        $data[31] = array("name"=>"United Kingdom","flag"=>"uk.png","url"=>"uk.fratres.net");
        $data[32] = array("name"=>"Vietnam","flag"=>"vn.png","url"=>"vn.fratres.net");
        $data[33] = array("name"=>"Bahrain","flag"=>"bh.png","url"=>"bh.fratres.net");
        $data[34] = array("name"=>"Brazil","flag"=>"br.png","url"=>"br.fratres.net");
        $data[35] = array("name"=>"Chile","flag"=>"cl.svg","url"=>"cl.fratres.net");
        $data[36] = array("name"=>"Egypt","flag"=>"eg.svg","url"=>"eg.fratres.net");
        $data[37] = array("name"=>"India","flag"=>"in.png","url"=>"in.fratres.net");
        $data[38] = array("name"=>"Japan","flag"=>"jp.png","url"=>"jp.fratres.net");
        $data[39] = array("name"=>"Lithuania","flag"=>"lt.png","url"=>"lt.fratres.net");
        $data[40] = array("name"=>"Mexico","flag"=>"mx.png","url"=>"mx.fratres.net");
        $data[41] = array("name"=>"Nigeria","flag"=>"ng.jpg","url"=>"ng.fratres.net");
        $data[42] = array("name"=>"Philippines","flag"=>"ph.png","url"=>"ph.fratres.net");
        $data[43] = array("name"=>"Qatar","flag"=>"qa.png","url"=>"qa.fratres.net");
        $data[44] = array("name"=>"Saudi Arabia","flag"=>"ksa.png","url"=>"ksa.fratres.net");
        $data[45] = array("name"=>"Sweden","flag"=>"se.png","url"=>"se.fratres.net");
        $data[46] = array("name"=>"Turkey","flag"=>"tr.png","url"=>"tr.fratres.net");
        $data[47] = array("name"=>"United States","flag"=>"us.png","url"=>"us.fratres.net");



        return $data;

    }
}








