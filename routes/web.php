<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin
Route::get('admin', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin', [App\Http\Controllers\Admin\Auth\LoginController::class, 'adminLogin']);

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('admin/home', [App\Http\Controllers\Admin\AdminHomeController::class, 'index'])->name('admin.home');
    
    Route::get('/create/quiz', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'create'])->name('create.quiz');
    Route::post('/store/quiz', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'store'])->name('store.quiz');
    Route::get('/all/quizzes', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'index'])->name('all.quizzes');

});

//Quiz Routes
