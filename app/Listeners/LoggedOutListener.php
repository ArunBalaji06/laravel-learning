<?php

namespace App\Listeners;

use App\Events\LoggedOut;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon;
use App\Models\EventListenerUser;

class LoggedOutListener
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
     * @param  \App\Events\LoggedOut  $event
     * @return void
     */
    public function handle(LoggedOut $event)
    {
        EventListenerUser::where('id',$event->user->id)->update([
            'logged_out' => Carbon\Carbon::now()
        ]);    }
}
