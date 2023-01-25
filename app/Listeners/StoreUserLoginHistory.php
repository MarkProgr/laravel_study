<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Http\Requests\SignInRequest;
use App\Models\LoginHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class StoreUserLoginHistory
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
     * @param  object  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        $entry = new LoginHistory();
        $entry->user_id = $event->user->id;
        $entry->time_of_attending = new \DateTime();
        $entry->ip = $event->request->ip();
        $entry->save();
    }
}
