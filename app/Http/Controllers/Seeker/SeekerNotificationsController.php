<?php

namespace App\Http\Controllers\Seeker;

use App\NotificationLogs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeekerNotificationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('seeker');

    }

    public function index(){

        $notification = new NotificationLogs();
        $notifications = $notification->seeker_logs()->latest()->paginate(10);


        return view('frontend.seeker.notifications.index', compact('notifications'));

    }
}
