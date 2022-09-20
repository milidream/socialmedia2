<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Orion\Http\Controllers\Controller;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Requests\Request;

class UserController extends Controller
{

    use DisableAuthorization;

    protected $model = User::class;

    protected function runIndexFetchQuery(Request $request, Builder $query, int $paginationLimit)
    {
        $results = parent::runIndexFetchQuery($request, $query, $paginationLimit);

        if ($request->has('include'))  {
            if (Str::contains($request->input('include'), 'friends')) {
                $results->map(function($result) {
                    $result->friends = $result->getFriends();
                    return $result;
                });
            }
        }

        return $results;
    }
}
