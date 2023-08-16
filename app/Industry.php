<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $fillable = [
        "name", "industry_slug", "total_jobs"
    ];

    public function jobs(){
        return $this->hasMany(Job::class, 'job_industry');
    }
}
