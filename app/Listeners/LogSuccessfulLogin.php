<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Auth\Events\Login;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        // update the user's last_login field in the database
        $user = $event->user;
        $user->last_login = Carbon::now()->toDateTimeString();
        $user->save();

        // add the login to the activity log
        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('logged in');
    }
}
