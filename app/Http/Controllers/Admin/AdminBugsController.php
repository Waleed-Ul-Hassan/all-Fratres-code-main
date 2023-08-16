<?php

namespace App\Http\Controllers\Admin;

use App\ActivityLogs;
use App\Http\Controllers\Controller;

class AdminBugsController extends Controller
{
    public function index()
    {
        $bugs = ActivityLogs::where("log_type", "error_app_running")->latest()->paginate(50);

        return view('admin.bugs.index', compact('bugs'));
    }

    public function bug_delete($id)
    {
        ActivityLogs::find($id)->delete();

        return redirect()->back();
    }



}

?>