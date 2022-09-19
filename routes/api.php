<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tokens/create/{user}', function (Request $request, User $user) {
    $token = $user->createToken('access_token');

    return ['token' => $token->plainTextToken];
});

Route::group(['as' => 'api.'], function() {
    Orion::resource('users', UserController::class);
    Orion::resource('posts', PostController::class);
    Orion::resource('comments', CommentController::class);
});
