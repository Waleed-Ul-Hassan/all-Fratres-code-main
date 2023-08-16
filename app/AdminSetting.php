<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{

    public function __construct(array $attributes = [])
    {
//        if(ip() == '39.53.131.207'){
        parent::__construct($attributes);
        $this->setConnection('mysql');
//        }

    }

    protected $fillable = [
        'public_logo',
        'website_is_free',
        'total_jobs'
    ];

    public $appTheme = [
        'theme_color' => "#fffff",
        'theme_font_color' => "#fffff",
        'job_title_color' => "#fffff",
        'job_title_size' => "12",
        'placeholder_color' => "#fffff",
        'placeholder_size' => "12",
        'success_color' => "#fffff",
        'primary_color' => "#fffff",
    ];

    public static function getSettings(){
        $settings = \App\AdminSetting::first();
        return $settings;
    }

    public function appSettings($coloumn){

            $settings = \App\AdminSetting::first();
            $settings = json_decode($settings->app_settings);
            if(isset($settings->$coloumn)){
                return $settings->$coloumn;
            }

            return $this->appTheme[$coloumn];

    }



}
