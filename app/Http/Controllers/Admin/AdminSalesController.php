<?php

namespace App\Http\Controllers\Admin;

use App\Coupon;
use App\SalesEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Tightenco\Collect\Support\LazyCollection;
use Illuminate\Support\Facades\File;

class AdminSalesController extends Controller
{


    public function index(){

        $user  = Auth::guard('admin')->user()->id;

        $sales  = SalesEmail::where("user_id", $user)->latest()->get();

//        AdminSalesController
        return view('admin.sales.index', compact('sales'));
    }

    public function add(){

        $user  = Auth::guard('admin')->user()->id;
        $coupons  = Coupon::where("start_date", "<=",Carbon::now()->format("Y-m-d"))
                    ->where("end_date", ">=",Carbon::now()->format("Y-m-d"))
                    ->where("discount", "!=",100)
                    ->get();

        $sales  = SalesEmail::where("user_id", $user)->latest()->get();
//        dd( $sales );
        return view('admin.sales.add', compact('sales','coupons'));

    }

    public function upload_emails(Request $request){

//        pre($_FILES, TRUE);

        $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);

        if($ext != 'txt'){
            return redirect()->back()->withErrors(['Please Upload Valid txt File']);
        }


        $path = public_path('sales/'. getDomainRoot() );

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        $public_filename = trim($request->filename).'-'.time().'.txt';

        move_uploaded_file($_FILES["file"]["tmp_name"], $path.'/'.$public_filename);

        $linecount = 0;
        $handle = fopen($path.'/'.$public_filename, "r");
        while(!feof($handle)){
            $line = fgets($handle);
            $linecount++;
        }

        fclose($handle);


        $data = array(
            "user_id" => Auth::guard('admin')->user()->id,
            "filename" => $request->filename,
            "file" => $public_filename,
            "last_sent	" => null,
            "emails" => $linecount,
        );
        SalesEmail::create($data);

        return redirect()->back()->withSuccess(['File Uploaded']);

    }

    public function getEmails(){

        $path = public_path('sales/'. getDomainRoot() );
        $id = decrypt($_GET['id']);
        $record = SalesEmail::find($id);


        if( $record ){

            $filename = $record->file;
            $handle = fopen($path.'/'.$filename, "r");
            $data = array();
            while(!feof($handle)){
                $data[] = fgets($handle);
            }

            fclose($handle);

            $response['data'] = view('frontend.emails.sales.ajax.list', compact('data'))->render();
            $response['file'] = $record->filename;

            return $response;
        }

    }

    public function send_emails(Request $request){

//        dd( $request->all() );

        $path = public_path('sales/'. getDomainRoot() );
        $record = SalesEmail::find(decrypt($request->rid));
        $coupon = Coupon::find($request->coupon);

        $filename = $record->file;
        $subject = $request->subject;
        $headline = $request->headline;

        if( $request->preview == 1 ){
            $email = "preview@email.com";
            $id = $record->id;
            return view('frontend.emails.sales.template-1', compact('email', 'id', 'coupon', 'headline'))->render();

        }

        if( $record ){

            $handle = fopen($path.'/'.$filename, "r");
            $data = array();
            while(!feof($handle)){
                $data[] = fgets($handle);
            }

//            dd( $data );

            fclose($handle);

            foreach ($data as $datum){

                $email = $datum;
                $id = encrypt($record->id);

                $mesg = view('frontend.emails.sales.template-1', compact('email', 'id', 'coupon', 'headline'))->render();
                verify_email($datum, $subject, $mesg);
            }

            return redirect()->back()->withSuccess(['Mail Sent Successfully']);

        }

    }


    public function delete_emails($id){

        $path = public_path('sales/'. getDomainRoot() );
        $record = SalesEmail::find($id);

        $file = $path.$record->file;


        if (file_exists($path)) {
            unlink($file);
        }

        $record->delete();

        return redirect()->back()->withSuccess(['File Deleted Successfully']);

    }


}
