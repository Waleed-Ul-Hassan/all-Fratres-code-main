<?php

namespace App\Http\Controllers\Api\Mobile\PublicLib;

use App\City;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AllController extends Controller
{
    use ApiResponse;

    public function cities(){
        $cities = City::orderBy("name", "ASC")->get();

        $data['cities'] = $cities;
        return $this->success("all cities", $data);
    }

}
