<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{

    public function __construct(array $attributes = [])
    {
        if(env("APP_ENV") != 'local'){
        parent::__construct($attributes);
        $this->setConnection('mysql_blog');
        }
    }


    protected $fillable = [
        "name",
        "flag",
        "url",
    ];



}
