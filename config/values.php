<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'recruiter_social_urls' => [
        'linkdin_redirect' => env('LINKEDIN_REDIRECT_URI_RECRUITER'),
        'facebook_redirect' => env('FACEBOOK_REDIRECT_URI_RECRUITER')
    ],




];
