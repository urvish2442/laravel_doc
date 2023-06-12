<?php

namespace App\Observers;

use App\Jobs\SendDeleteUserEmail;
use App\Mail\UserDeleteMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;

class UserObserver
{
    public function creating(User $user)
    {
        $randomNumber = mt_rand(100000, 999999);
        $user->refnum = $randomNumber;
    }
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
//        Queue::push(new SendDeleteUserEmail($user));
//        Mail::to($user->email)->queue(new UserDeleteMail());
//        SendDeleteUserEmail::dispatch($user);
        dispatch(new SendDeleteUserEmail($user->email));
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
