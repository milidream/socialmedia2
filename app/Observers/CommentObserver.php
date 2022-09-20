<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentObserver
{
    public function creating(Comment $comment)
    {
        $comment->owner()->associate(Auth::user());
    }

    public function created(Comment $comment)
    {
        //
    }

    public function updated(Comment $comment)
    {
        //
    }

    public function deleted(Comment $comment)
    {
        //
    }

    public function restored(Comment $comment)
    {
        //
    }

    public function forceDeleted(Comment $comment)
    {
        //
    }
}
