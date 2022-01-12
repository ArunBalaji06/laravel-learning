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
    public function creating(ObserverUser $observerUser)
    {
        // dd($observerUser);
        // $observerUser->update([
        //     'slug' => $observerUser->name.'-'.$observerUser->email
        // ]);
        // Log::info('created');
        $observerUser->slug = $observerUser->name.'-'.$observerUser->email;
    }

    /**
     * Handle the ObserverUser "updated" event.
     *
     * @param  \App\Models\ObserverUser  $observerUser
     * @return void
     */
    public function updating(ObserverUser $observerUser)
    {
        // dd($observerUser);
        $count = (int)$observerUser->updated_count;
        // dd($count);
        $observerUser->updated_count = $count+1;
    }

    /**
     * Handle the ObserverUser "deleted" event.
     *
     * @param  \App\Models\ObserverUser  $observerUser
     * @return void
     */
    public function deleting(ObserverUser $observerUser)
    {
        // dd(\Carbon\Carbon::now());
        ObserverUser::create([
            'name' => $observerUser->name,
            'email' =>$observerUser->email,
            'slug' => $observerUser->slug,
            'updated_count' => $observerUser->updated_count,
            'status' => 1,
            'deleted_at' => \Carbon\Carbon::now()
        ]);
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
        dd('forcedelete');
    }
}
