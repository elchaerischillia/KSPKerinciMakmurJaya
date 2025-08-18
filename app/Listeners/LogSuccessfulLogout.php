<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\ActivityLog;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        ActivityLog::create([
            'user_id'    => $event->user->id,
            'action'     => 'logout',
            'module'     => 'auth',
            'description'=> 'User logged out',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}
