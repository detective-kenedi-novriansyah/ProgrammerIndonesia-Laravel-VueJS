<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::get('/', function() {
//     return view('home');
// });

Route::group([
    'middleware' => 'api',
    'prefix' => ''
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
    Route::post('create', [AuthController::class, 'store']);
    Route::get('profile/{token}', [AuthController::class, 'profile']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => ''
], function ($router) {
    Route::get('post', [PostController::class, "index"]);
    Route::post('post/store/', [PostController::class, 'store']);
    Route::get('post/{id}', [PostController::class, 'show']);
    Route::put('post/{id}', [PostController::class, 'update']);
    Route::delete('post/{id}', [PostController::class, 'destroy']);
});

// Route::resource('user', 'AuthController');

// Route::resource('users', 'UserAPIController');

// Route::resource('openapis', App\Http\Controllers\API\OpenapiAPIController::class);