<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogActivity
{
    public static function addToLog($action, $module = null, $description = null)
    {
        ActivityLog::create([
            'user_id'    => Auth::id(),
            'action'     => $action,
            'module'     => $module,
            'description'=> $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}
