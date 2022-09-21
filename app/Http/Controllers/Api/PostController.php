<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Orion\Concerns\DisablePagination;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;



class PostController extends Controller
{

    protected $model = Post::class;
    protected string $relation = 'comments';

    use DisableAuthorization;
    use DisablePagination;

    public function includes(): array
    {
        return [
            'owner'
        ];
    }
}
