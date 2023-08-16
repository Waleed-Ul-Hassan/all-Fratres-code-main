<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
>
<head>
    <meta charset="utf-8"> <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width"> <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- Use the latest (edge) version of IE rendering engine -->
    <meta name="x-apple-disable-message-reformatting">  <!-- Disable auto-scale in iOS 10 Mail entirely -->
    <title>Fratres Jobs Alerts</title> <!-- The title tag shows in email notifications, like Android 4.4. -->

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">

    <!-- CSS Reset : BEGIN -->
    <style>

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            background: #f1f1f1;
        }

        /* What it does: Stops email clients resizing small text. */
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        /* What it does: Centers email on Android 4.4 */
        div[style*="margin: 16px 0"] {
            margin: 0 !important;
        }

        /* What it does: Stops Outlook from adding extra spacing to tables. */
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        /* What it does: Fixes webkit padding issue. */
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            /*margin: 0 auto !important;*/
        }

        /* What it does: Uses a better rendering method when resizing images in IE. */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
        a {
            text-decoration: none;
        }

        /* What it does: A work-around for email clients meddling in triggered links. */
        *[x-apple-data-detectors], /* iOS */
        .unstyle-auto-detected-links *,
        .aBn {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
        .a6S {
            display: none !important;
            opacity: 0.01 !important;
        }

        /* What it does: Prevents Gmail from changing the text color in conversation threads. */
        .im {
            color: inherit !important;
        }

        /* If the above doesn't work, add a .g-img class to any image in question. */
        img.g-img + div {
            display: none !important;
        }

        /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
        /* Create one of these media queries for each additional viewport size you'd like to fix */

        /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
        @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
            u ~ div .email-container {
                min-width: 320px !important;
            }
        }

        /* iPhone 6, 6S, 7, 8, and X */
        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            u ~ div .email-container {
                min-width: 375px !important;
            }
        }

        /* iPhone 6+, 7+, and 8+ */
        @media only screen and (min-device-width: 414px) {
            u ~ div .email-container {
                min-width: 414px !important;
            }
        }


    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style>

        .primary {
            background: #17bebb;
        }

        .bg_white {
            background: #ffffff;
        }

        .bg_light {
            background: #f7fafa;
        }

        .bg_black {
            background: #000000;
        }

        .bg_dark {
            background: rgba(0, 0, 0, .8);
        }

        .email-section {
            padding: 2.5em;
        }

        /*BUTTON*/
        .btn {
            padding: 10px 15px;
            display: inline-block;
        }

        .btn.btn-primary {
            border-radius: 5px;
            background: #17bebb;
            color: #ffffff;
        }

        .btn.btn-white {
            border-radius: 5px;
            background: #ffffff;
            color: #000000;
        }

        .btn.btn-white-outline {
            border-radius: 5px;
            background: transparent;
            border: 1px solid #fff;
            color: #fff;
        }

        .btn.btn-black-outline {
            border-radius: 0px;
            background: transparent;
            border: 2px solid #000;
            color: #000;
            font-weight: 700;
        }

        .btn-custom {
            color: rgba(0, 0, 0, .3);
            text-decoration: underline;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            color: #000000;
            margin-top: 0;
            font-weight: 400;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-size: 15px;
            line-height: 1.8;
            color: rgba(0, 0, 0, .4);
        }

        a {
            color: #040404;
        }

        table {
        }

        /*LOGO*/

        .logo h1 {
            margin: 0;
        }

        .logo h1 a {
            color: #17bebb;
            font-size: 24px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
        }

        /*HERO*/
        .hero {
            position: relative;
            z-index: 0;
        }

        .hero .text {
            color: rgba(0, 0, 0, .3);
        }

        .hero .text h2 {
            color: #000;
            font-size: 34px;
            margin-bottom: 0;
            font-weight: 200;
            line-height: 1.4;
        }

        .hero .text h3 {
            font-size: 24px;
            font-weight: 300;
        }

        .hero .text h2 span {
            font-weight: 600;
            color: #000;
        }

        .text-author {
            bordeR: 1px solid rgba(0, 0, 0, .05);
            max-width: 50%;
            margin: 0 auto;
            padding: 2em;
        }

        .text-author img {
            border-radius: 50%;
            padding-bottom: 20px;
        }

        .text-author h3 {
            margin-bottom: 0;
        }

        ul.social {
            padding: 0;
        }

        ul.social li {
            display: inline-block;
            margin-right: 10px;
        }

        /*FOOTER*/

        .footer {
            border-top: 1px solid rgba(0, 0, 0, .05);
            color: rgba(0, 0, 0, .5);
        }

        .footer .heading {
            color: #000;
            font-size: 20px;
        }

        .footer ul {
            margin: 0;
            padding: 0;
        }

        .footer ul li {
            list-style: none;
            margin-bottom: 10px;
        }

        .footer ul li a {
            color: rgba(0, 0, 0, 1);
        }


        @media screen and (max-width: 500px) {


        }


    </style>


</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
<center style="width: 100%; background-color: #f1f1f1;">
    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
               style="margin: auto;">
            <tr>
                <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="logo" style="text-align: center;">
                                <h1><a href="#">
                                        <img src="{{asset('logo/'.$settings->public_logo)}}" alt="Fratres">
                                    </a></h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero bg_white">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
                                <div class="text">
                                    <h3>
                                        {{count($jobs)}}+ new opportunities for you
                                        <p style="font-size: 12px;">These job alerts match your saved job alert on Fratres *</p>
                                    </h3>

                                </div>
                                <div style="border: 2px solid;border-radius: 14px; border-color: #F68A1F;">
                                </div>
                                @foreach($jobs as $job)
                                    @if($job->is_external == 1)
                                        <a href="{{url('job/'.encrypt($job->id).'?isExternal=true')}}" style="text-decoration: none;">
                                            @else
                                                <a href="{{url('job/'.$job->slug)}}" style="text-decoration: none;">
                                                    @endif
                                    <table>

                                        <tr>
                                            <td style="padding-top: 25px;text-align: left;">
                                                <h3 style="margin-bottom: 0px;text-decoration: underline;font-weight:bold;">
                                                    {{$job->title}}
                                                </h3>
                @php
                    $company_name = '';
                    $company_location = '';
                if($job->is_external == 1){
                    $company = json_decode($job->company);
                    if(isset($company->name) && $company->name != ''){
                        $company_name = $company->name;
                    }
                    $company_location = $job->location_string;
                }
                @endphp

                                        @if($job->is_external == 1)
                                            <span style="color: #000b16;font-size:13px;">{{$company_name}}</span>
                                            <span style="margin-left:5px;margin-right:5px; ">-</span>
                                            <span style="color:#767676;font-size:13px;">{{$company_location}}</span>
                                        @else
                                            <span style="font-family: 'Karla', Arial, sans-serif;font-size: 14px;line-height: 14px;font-weight: 400; color:#7E7E7E; margin: 0; margin-bottom: 0px ;">{{$job->recruiter}}</span>
                                        @endif
                                        @if($job->is_external == 0)
                                            {{$job->city}}
                                        @endif
                                        <span style="float:right;font-size: 13px;margin-right: 20px">{{date("M d", strtotime($job->created_at))}}</span>

                                                <br>
                                                <p style="font-family: 'Karla', Arial, sans-serif;font-size: 12px;line-height: 16px;font-weight: 400; color:#7E7E7E; margin: 0; margin-bottom: 0px ;">
                                                    {!! Str::limit($job->description, 300) !!}
                                                </p>

                                            </td>

                                        </tr>
                                    </table>
                                                </a>
                                        @endforeach

                                                <a href="{{url('search')}}" style="background-color: #F68A1F;border-radius: 20px 20px;padding: 10px; color: #fff;font-size: 14px;width: 258px;display: block;margin: 0 auto;margin-top: 40px;">See More Jobs</a>

                                                {{--<p style="margin: 0; font-size: 13px;color:#000;">You received this email because you just signed up for a new account on {{$settings->website_title}}. </p>--}}
                            </td>

                    </table>
                </td>
            </tr>
            <!-- end tr -->
            <!-- 1 Column Text + Button : END -->
        </table>
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
               style="margin: auto;">
            <!-- end: tr -->
            <tr>
                <td class="bg_light" style="text-align: center;background-color: #F1F1F1;">
                    <p>© {{date("Y")}} Fratres {{$settings->country_name}}.</p>
                </td>
            </tr>

        </table>

        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%"
               style="margin: auto;">
            <!-- end: tr -->
            <tr>
                <td class="bg_light" style="width:200px;color: #085ff7; text-align: right;background-color: #F1F1F1;">
                    <a href="{{url('privacy')}}" style="color: #085ff7;font-size: 12px;">Privacy Policy</a>
                </td>
                <td class="bg_light" style="width:50px; text-align: center;background-color: #F1F1F1;">
                    |
                </td>
                <td class="bg_light" style="width:200px;color: #085ff7;text-align: left;background-color: #F1F1F1;">
                    <a href="{{url('terms')}}" style="color: #085ff7;font-size: 12px;">Terms & Conditions</a>
                </td>
            </tr>
            <tr>
                <td class="bg_light" style="width:200px;color: #085ff7; text-align: right;background-color: #F1F1F1;">
                    <a href="{{url('manage-subscriptions/'.encrypt($alert->email))}}" style="color: #085ff7;font-size: 12px;">Manage Subscriptions</a>
                </td>
                <td class="bg_light" style="width:10px; text-align: center;background-color: #F1F1F1;">
                    |
                </td>
                <td class="bg_light" style="width:200px;color: #085ff7;text-align: left;background-color: #F1F1F1;">
                    <a href="{{url('email-preferences/unsubscribe/'.$alert->random_id)}}" style="color: #085ff7;font-size: 12px;">Unsubscribe from this email</a>
                </td>
            </tr>
            <tr>
                <td class="bg_light" style="width:200px;color: #085ff7; text-align: right;background-color: #F1F1F1;">
&nbsp;
                </td>
                <td class="bg_light" style="width:10px; text-align: center;background-color: #F1F1F1;">
&nbsp;
                </td>
                <td class="bg_light" style="width:200px;color: #085ff7;text-align: left;background-color: #F1F1F1;">
      &nbsp;
                </td>
            </tr>

            <br>
        </table>


    </div>
</center>
</body>
</html>