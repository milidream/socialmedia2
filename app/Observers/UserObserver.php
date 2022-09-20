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
        $user->likedComments()->detach();
        $user->comments->each->delete();
        $user->likedPosts()->detach();
        $user->posts->each->delete();
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
