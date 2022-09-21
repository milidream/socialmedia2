<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Post $post)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Post $post)
    {
        if($user->can('update all posts')){
            return true;
        } elseif($user->can('update own posts')){
            return $user->posts()->is($user);
        }
        return false;

    }

    public function delete(User $user, Post $post)
    {
        if($user->can('delete all posts')){
            return true;
        } elseif($user->can('delete own posts')){
            return $user->posts()->is($user);
        }
        return false;
    }

    public function restore(User $user, Post $post)
    {
        //
    }

    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
