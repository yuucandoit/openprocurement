<?php

namespace App\Http\Controllers;

use App\Models\ActivityLogs;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsController extends Controller
{
    public function index()
    {
        $data = Activity::orderBy('created_at','DESC')->paginate(10);
        return view('activity_logs.index')
        ->with('data',$data);
    }

    public function search(Request $request)
    {
        $cari= $request->cari;

        $data = Activity::where('description','like',"%".$cari."%")
                ->orWhere('event','like',"%".$cari."%")
                ->orWhere('subject_type','like',"%".$cari."%")
                ->orWhere('created_at','like',"%".$cari."%")
                ->orWhere('properties','LIKE',"%".$cari."%")
                ->orderBy('created_at','DESC')->paginate(10);
        return view('activity_logs.index')
        ->with('data',$data);
    }
}
