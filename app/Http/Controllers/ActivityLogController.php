<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activityLog = ActivityLog::all();

        return view('activity-log.index', compact('activityLog'));
    }
}
