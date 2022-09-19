<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;

class CommentController extends Controller
{

    protected $model = Comment::class;

    use DisableAuthorization;

}
