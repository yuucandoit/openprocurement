<?php

namespace App\Http\Controllers;

use App\Models\ActivityLogs;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsController extends Controller
{
    public function index()
    {
        $data = Activity::paginate(10);
        return view('activity_logs.index')
        ->with('data',$data);
    }
}
