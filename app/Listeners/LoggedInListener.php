<?php

namespace App\Listeners;

use App\Events\LoggedIn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon;
use App\Models\EventListenerUser;

class LoggedInListener
{
    public $event;
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
     * @param  \App\Events\LoggedIn  $event
     * @return void
     */
    public function handle(LoggedIn $event)
    {
        EventListenerUser::where('id',$event->user->id)->update([
            'logged_in' => Carbon\Carbon::now()
        ]);
    }
}
