<?php

namespace App\Http\Controllers\Recruiter;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecruiterInvoicesController extends Controller
{
    public function index(){
        $orders = Order::where('recruiter_id', recruiter_logged('id'))->orderBy('id','DESC')->get();
        // dd($orders);

        return view('frontend.recruiter.invoices.index', compact('orders'));
    }

    public function invoice_detail($id){

        $orders = Order::find(decrypt($id));
        if($orders){
            return view('frontend.recruiter.invoices.invoice-public', compact('orders'));
        }else{
            abort(404);
        }


    }


}
