<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user)
    {
        //
    }

    public function updated(User $user)
    {
        //
    }

    public function deleting(User $user)
    {
        $user->comments()->delete();
    }

    public function deleted(User $user)
    {
        //
    }

    public function restored(User $user)
    {
        //
    }

    public function forceDeleted(User $user)
    {
        //
    }
}
