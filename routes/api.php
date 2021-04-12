<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

//api user 
Route::group([

    'middleware' => 'apiUser',
    'prefix' => 'authUser'

], function ($router) {

    Route::post('login', [App\Http\Controllers\Jwt\User\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\Jwt\User\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\Jwt\User\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\Jwt\User\AuthController::class, 'me']);

});

Route::group([
    
    'middleware' => 'apiAdmin',
    'prefix' => 'authAdmin'

], function ($router) {

    Route::post('login', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'me']);

});



