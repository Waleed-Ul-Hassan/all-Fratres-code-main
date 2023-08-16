<?php

namespace App\Http\Controllers\Front;


use App\SalesEmail;
use App\Traits\JobsImport\ApiJobs;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    use ApiJobs;

    public function unsub($id , $email)
    {
        $path = public_path('sales/'. getDomainRoot() );
        $record = SalesEmail::find(decrypt($id));

        if( $record ){

            $handle = fopen($path.'/'.$record->file, "r");

            $data = array();
            while(!feof($handle)){
                $email_file = fgets($handle);
                if($email == $email_file){
                    continue;
                }elseif ($email_file == "\n"){
                    continue;
                }else{
                    $data[] = trim($email_file);
                }
            }

            $result = array_filter($data);
//            dd($result);

            $record->emails = count($result);
            $record->save();

            $file = fopen($path.'/'.$record->file,"w");
            fwrite($file,implode($result, "\n"));
            fclose($file);

            $notification = swal_alert_message("We are sad seeing you go :( ", '', 'Okay', 'success');
            return redirect('/')->with($notification);

        }

    }

}

?>