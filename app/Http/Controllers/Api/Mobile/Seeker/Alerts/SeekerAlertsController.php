<?php

namespace App\Http\Controllers\Api\Mobile\Seeker\Alerts;

use App\JobAlert;
use App\NotificationLogs;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeekerAlertsController extends Controller
{
    use ApiResponse;

    public function index(Request $request){

        try{
            $seeker = $request->seekerIs;
            $alerts = JobAlert::where('email', $seeker->email)->orderBy('id', 'desc')->get();
            if($alerts){
                $data['alerts'] = JobAlert::where('email', $seeker->email)->with('city','industry')->orderBy('id', 'desc')->get();
                return $this->success('alerts', $data);
            }else{
                return $this->error('Alerts not found');
            }
        }catch (\Exception $exception){
            return $this->error($exception->getMessage());
        }

    }

    public function delete(Request $request){

        $id = $request->id;
        try{
            $job_alert = JobAlert::find($id);
            if($job_alert){
                $job_alert->delete();

                NotificationLogs::create([
                    "notifier_id" => $request->seekerIs->id,
                    "notifier_type" => 'seeker',
                    "message" => 'You have deleted your alert successfully',
                    "url" => "#",
                ]);
                return $this->success('You have deleted your alert successfully');

            }else{
                return $this->error('Alert not found');
            }
        }catch (\Exception $exception){
            return $this->error($exception->getMessage());
        }
    }

}
