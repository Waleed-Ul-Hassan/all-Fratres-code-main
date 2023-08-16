<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeekerExperience extends Model
{

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $table = 'seeker_experiences';

    protected $fillable = [
       'seeker_id', 'job_title', 'company' ,'date_start', 'date_end', 'reference_email','reference_number', 'description','job_city','job_country'
    ];


    public function seeker(){
        $this->belongsTo(Seeker::class);
    }
}
