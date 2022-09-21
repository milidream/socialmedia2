<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Comment $comment)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Comment $comment)
    {
        if($user->can('update all comments')){
            return true;
        } elseif($user->can('update own comments')){
            return $user->comments()->is($user);
        }
        return false;
    }

    public function delete(User $user, Comment $comment)
    {
        if($user->can('delete all comments')){
            return true;
        } elseif($user->can('delete own comments')){
            return $user->comments()->is($user);
        }
        return false;
    }

    public function restore(User $user, Comment $comment)
    {
        //
    }

    public function forceDelete(User $user, Comment $comment)
    {
        //
    }
}
