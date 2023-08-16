<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $fillable = [
      'total_jobs'
    ];

    public function jobs(){
        return $this->belongsToMany(Job::class);
    }

    public function seekers() {
        return $this->belongsToMany(Seeker::class);
    }

}
