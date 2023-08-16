<?php

namespace App\Http\Controllers\Admin;

use App\CollectNewsletter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Exception;
use App\Traits\ExternalJobs;

class AdminNewslettersController extends Controller
{
    use ExternalJobs;

    public function index(){

//        pre($this->WhatJobs(), 1);

        $emails = CollectNewsletter::orderby('id', 'desc')->get();
        return view('admin.newsletter.index', compact('emails'));
    }

    public function delete($id){


        try{

            CollectNewsletter::find($id)->delete();
            $response['status'] = 1;
            return \Response::json($response);

        }catch(\Exception $e){

            $response['status'] = 0;
            return \Response::json($response);
        }





    }
}
