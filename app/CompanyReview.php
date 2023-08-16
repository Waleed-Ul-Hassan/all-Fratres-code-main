<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }
    
    protected $fillable = [
        "company_id","rating","employee_type","email","comments"
    ];


    public function company(){
        return $this->belongsToMany(Recruiter::class, "recruiters", "company_id");
    }

}
