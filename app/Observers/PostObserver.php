<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    public function creating(Post $post)
    {
        $post->owner()->associate(Auth::user());
    }

    public function created(Post $post)
    {
        //
    }

    public function updated(Post $post)
    {
        //
    }

    public function deleting(Post $post)
    {
        $post->userLiked()->detach();
        $post->comments->each->delete();
    }

    public function deleted(Post $post)
    {
        //
    }

    public function restored(Post $post)
    {
        //
    }

    public function forceDeleted(Post $post)
    {
        //
    }
}
