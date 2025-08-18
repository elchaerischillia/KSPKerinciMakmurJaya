<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogActivity;

class LogActivityController extends Controller
{
    /**
     * Menampilkan daftar log aktivitas
     */
    public function index()
    {
        $logs = LogActivity::with('user')->latest()->paginate(10);

        return view('backsite.log_activity.index', compact('logs'));
    }
}
