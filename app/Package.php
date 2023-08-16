<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    public function features(){
        return $this->hasMany(PackageFeature::class);
    }
}
