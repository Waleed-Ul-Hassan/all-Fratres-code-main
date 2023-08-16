<?php

namespace App\Http\Controllers\Front;

use App\City;
use App\Flag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class AjaxController extends Controller
{

    public function cities($q){

        $city = City::whereRaw("name LIKE '%".$q."%'")->select('name')->get();
        return $city;

    }


    public function cookie(){
         Cookie::queue('job_box', true, 604800, null,'.fratres.net');

    }


    public function countries(){
        $flags = Flag::all();
        foreach ($flags as $flag){
            $result[] = array("name" => trim($flag->name), "url" => trim($flag->url) );
        }

        return $result;
    }


    
}
