<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\RelationController;

class UserPostsController extends RelationController
{
    use DisableAuthorization;
    protected $model = User::class;
    protected $relation = 'likedPosts';
}
