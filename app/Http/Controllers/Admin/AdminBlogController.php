<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class AdminBlogController extends Controller
{


    public function blogs(Request $request){


        $blogs = file_get_contents('http://blog.fratres.net/api/blogs');

        $blogsJsonDecode = json_decode($blogs, true);

//        foreach ($blogsJsonDecode as $blog){
//            echo '<pre>';
//            print_r($blog);
//        }

        return view('admin.blogs.index',compact('blogsJsonDecode'));

    }

    public function singleblogs($id){


        $blogs = file_get_contents('http://blog.fratres.net/api/blogs/'.$id);

        $blogsJsonDecode = json_decode($blogs, true);

//        foreach ($blogsJsonDecode as $blog){
//            echo '<pre>';
//            print_r($blog);
//        }

        return view('admin.blogs.details',compact('blogsJsonDecode'));

    }



    public function users(Request $request){


        return view('admin.blogs.users');

    }



}
