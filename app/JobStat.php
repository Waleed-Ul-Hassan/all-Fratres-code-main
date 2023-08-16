<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobStat extends Model
{
    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }
    
    public $table = 'job_stats';

    public $fillable = [
      'job_id',
      'ip_address',
      'browser',
      'visits',
      'country',
      'city',
      'lat',
      'lon',
      'timezone',
      'isp',
      'region',
      'regionname',
      'countrycode',
      'zip',
      'views',
    ];


    public function increment_views(){
        return $this->update(['views' => $this->views +1]);
    }





}
