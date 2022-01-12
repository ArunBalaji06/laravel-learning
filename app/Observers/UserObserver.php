<?php

namespace App\Observers;

use App\Models\ObserverUser;

class UserObserver
{
    /**
     * Handle the ObserverUser "created" event.
     *
     * @param  \App\Models\ObserverUser  $observerUser
     * @return void
     */
    public function created(ObserverUser $observerUser)
    {
        // dd($observerUser);
        $observerUser->update([
            'slug' => $observerUser->name.'-'.$observerUser->email
        ]);
        // Log::info('created');
    }

    /**
     * Handle the ObserverUser "updated" event.
     *
     * @param  \App\Models\ObserverUser  $observerUser
     * @return void
     */
    public function updated(ObserverUser $observerUser)
    {
        // dd($observerUser);
        $count = (int)$observerUser->updated_count;
        $observerUser->update([
            'updated_count' => $count + 1
        ]);
    
    }

    /**
     * Handle the ObserverUser "deleted" event.
     *
     * @param  \App\Models\ObserverUser  $observerUser
     * @return void
     */
    public function deleted(ObserverUser $observerUser)
    {
        //
    }

    /**
     * Handle the ObserverUser "restored" event.
     *
     * @param  \App\Models\ObserverUser  $observerUser
     * @return void
     */
    public function restored(ObserverUser $observerUser)
    {
        //
    }

    /**
     * Handle the ObserverUser "force deleted" event.
     *
     * @param  \App\Models\ObserverUser  $observerUser
     * @return void
     */
    public function forceDeleted(ObserverUser $observerUser)
    {
        //
    }
}
