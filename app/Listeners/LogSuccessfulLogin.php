<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\ActivityLog;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        ActivityLog::create([
            'user_id'    => $event->user->id,
            'action'     => 'login',
            'module'     => 'auth',
            'description'=> 'User logged in',
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }
}
