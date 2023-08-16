<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountRecruiter extends Model
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection('mysql_accounts');
    }

    protected $table = 'recruiters';

    protected $fillable = [
        "original_id",
        "country_is",
        "total_jobs",
        "parent",
        "job_credits",
        "billing_details",
        "company_name",
        "company_slug",
        "company_url",
        "email",
        "password",
        "company_logo",
        "company_size",
        "creator_name",
        "creator_position",
        "phone",
        "country",
        "city",
        "industry",
        "company_description",
        "is_social_login",
        "social_login_id",
        "social_channel",
        "is_blocked",
        "email_verified_at",
        "confirm_email_random_id",
        "social_token",
        "remember_token",
        "stripe_customer_id",
        "cv_purchased_validity",
        "deleted_at",
    ];

}

