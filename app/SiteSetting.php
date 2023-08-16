<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{


    protected $table = 'site_settings';
//    protected $table = 'admin_settings';

    public function __construct(array $attributes = [])
    {
        if(env("APP_ENV") != 'local'){

        parent::__construct($attributes);
        $this->setConnection('mysql_blog');
        }
    }



}
