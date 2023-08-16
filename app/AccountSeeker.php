<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountSeeker extends Model
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection('mysql_accounts');
    }

    protected $table = 'seekers';

    protected $fillable = [
        'original_id',
        'country_is',
        'profile_complete',
        'total_alerts',
        'first_name',
        'last_name',
        'email',
        'password',
        'avatar',
        'postcode',
        'current_job_title',
        'current_company',
        'gender',
        'phone',
        'dob',
        'expected_salary',
        'experience_years',
        'available_job_type',
        'country',
        'city',
        'industries',
        'cv_resume',
        'relocate',
        'reg_step',
        'skills',
        'saved_jobs',
        'is_social_login',
        'social_login_id',
        'social_channel',
        'is_blocked',
        'email_verified_at',
        'confirm_email_random_id',
        'social_token',
        'remember_token',
        'martial_status',
        'degree_level',
        'career_level',
        'website_portfolio',
        'facebook_profile',
        'twitter_profile',
        'linkdin_profile',
        'github_profile',
        'hobbies',
        'languages',
        'seeking_job',
        'username',
        'is_upgraded',
        'expiry_upgrade',
        'stripe_customer_id',
        'summary'
    ];
}
