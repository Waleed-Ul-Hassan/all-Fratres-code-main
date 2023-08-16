<?php

namespace App\Http\Controllers\Api\Mobile\Recruiter\Dashboard;

use App\NotificationLogs;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecruiterNotificationsController extends Controller
{
    use ApiResponse;
    public function index(Request $request){

        $notification = new NotificationLogs();
        $notifications = $notification->where("notifier_type", 'recruiter')->where("notifier_id", $request->recruiterIs->id)->latest()->paginate(10);

        $response['notifications'] = $notifications;
        return $this->success("Notifications", $response);


    }

}
