<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog; // Asegúrate de que este sea el modelo correcto para tu activity log
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Obtener todos los registros del activity log
        $activityLog = ActivityLog::all(); // Si tienes paginación, puedes usar ->paginate()

        return view('activity-log.index', compact('activityLog'));
    }
}
