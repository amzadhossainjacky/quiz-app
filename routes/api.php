<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* 
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
 */

//api user 
Route::group([

    'middleware' => 'apiUser',
    'prefix' => 'authUser'

], function ($router) {

    //api authentication for user
    Route::post('login', [App\Http\Controllers\Jwt\User\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\Jwt\User\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\Jwt\User\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\Jwt\User\AuthController::class, 'me']);

});

//api admin
Route::group([
    
    'middleware' => 'apiAdmin',
    'prefix' => 'authAdmin'

], function ($router) {

    //api authentication for admin 
    Route::post('login', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\Jwt\Admin\AuthController::class, 'me']);

    //api for quizzes 

    //fetch all quizzes
    Route::get('quiz/list', [App\Http\Controllers\Api\Admin\QuizController::class, 'index']);
    //fetch single quiz 
    Route::get('quiz/list/{id}', [App\Http\Controllers\Api\Admin\QuizController::class, 'show']);
});





