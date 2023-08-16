<?php

namespace App\Http\Controllers\Api\Mobile\PublicLib;

use App\AdminSetting;
use App\City;
use App\Flag;
use App\Industry;
use App\Traits\ApiResponse;
use App\WebStat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class AllController extends Controller
{
    use ApiResponse;

    public function cities(){
        $cities = City::orderBy("name", "ASC")->get();

        $data['cities'] = $cities;
        return $this->success("all cities", $data);
    }

    public function industries(){
        $industries = Industry::orderBy("name", "ASC")->get();

        $data['industries'] = $industries;
        return $this->success("all cities", $data);
    }

    public function countries(){
        $countries = Flag::orderBy("name", "ASC")->get();

        $staging = (object) array("id" => 333, "name" => "staging", "url" => "staging.fratres.net", "flag" => "uk");
        try{
//            $staging = new Collection();
//            $staging->id = 333;
//            $staging->name = "staging";
//            $staging->url = "staging.fratres.net";
//            $staging->flag = "staging.fratres.net";
//            $staging->save();
//dd($staging);
            $countries->push($staging);

        }catch (\Exception $e){
            dd($e->getMessage());
        }

        $allMessages = $countries->map(function ($message, $key) {

            $message->flag = 'https://zw.fratres.net/frontend/assets/flags/'.$message->flag;

            return $message;
        });



        $data['countries'] = $allMessages;
        return $this->success("all countries", $data);
    }

    public function total_jobs(){
        $settings = WebStat::first();

        $data['jobs'] = $settings->total_jobs;
        return $this->success("Total Jobs", $data);
    }







}
