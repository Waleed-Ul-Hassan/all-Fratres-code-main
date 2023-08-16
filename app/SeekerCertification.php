<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeekerCertification extends Model
{
    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $fillable = [
        'seeker_id', 'certification_name', 'license_number' ,'completion_date', 'end_date', 'certification_authority','certification_url'
    ];


    public function seeker(){
        $this->belongsTo(Seeker::class);
    }
}
