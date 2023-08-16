<?php

namespace App\Http\Controllers\Recruiter;

use App\NotificationLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecruiterNotificationsController extends Controller
{
    public function index(){

        $notification = new NotificationLogs();
        $notifications = $notification->recruiter_logs()->latest()->paginate(10);


        return view('frontend.recruiter.notifications.index', compact('notifications'));

    }
}
