<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeekerProject extends Model
{

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $fillable = [
        'seeker_id', 'project_title', 'company' ,'date_start', 'date_end', 'project_url','client_name', 'description','client_url'
    ];


    public function seeker(){
        $this->belongsTo(Seeker::class);
    }

}
