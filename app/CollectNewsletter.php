<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectNewsletter extends Model
{

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }
    
    protected $fillable = [ "email" ];
}
