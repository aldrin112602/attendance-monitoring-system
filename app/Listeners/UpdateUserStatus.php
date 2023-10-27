<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Fortify\Http\Responses\LoginResponse;

class UpdateUserStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoginResponse $event): void
    {
        //
        $user = Auth::user(); // Get the authenticated user
        if ($user) {
            
            // $user->update(['status' => 'active']);
        }
    }
}
