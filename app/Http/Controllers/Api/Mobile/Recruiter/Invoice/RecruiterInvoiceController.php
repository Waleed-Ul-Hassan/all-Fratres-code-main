<?php

namespace App\Http\Controllers\Api\Mobile\Recruiter\Invoice;

use App\Order;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecruiterInvoiceController extends Controller
{
    use ApiResponse;
    public function index(Request $request){
        $orders = Order::where('recruiter_id', $request->recruiterIs->id)->orderBy('id','DESC')->get();

        $data['orders'] = $orders;
        return $this->success('Orders', $data);
    }

    public function invoice_detail(Request $request){

        $id = $request->id;
        $orders = Order::find($id);
        if($orders){

            $data['orders'] = $orders;
            return $this->success('Orders Detail', $data);

        }else{
            return $this->error('Order not found');
        }

    }

}
