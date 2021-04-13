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

//admin auth Routes
Route::get('admin', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin', [App\Http\Controllers\Admin\Auth\LoginController::class, 'adminLogin']);

//admin routes
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('admin/home', [App\Http\Controllers\Admin\AdminHomeController::class, 'index'])->name('admin.home');

    //Quiz Routes
    Route::get('/create/quiz', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'create'])->name('create.quiz');
    Route::post('/store/quiz', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'store'])->name('store.quiz');
    Route::get('/all/quizzes', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'index'])->name('all.quizzes');
    Route::get('/edit/quiz/{id}', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'edit'])->name('edit.quiz');
    Route::post('/update/quiz/{id}', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'update'])->name('update.quiz');
    Route::get('/delete/quiz/{id}', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'destroy'])->name('delete.quiz');

    //Section Routes
    Route::get('/create/section', [App\Http\Controllers\Admin\Section\SectionController::class, 'create'])->name('create.section');
    Route::post('/store/section', [App\Http\Controllers\Admin\Section\SectionController::class, 'store'])->name('store.section');

    //QuestionRoutes
    Route::get('/create/Question', [App\Http\Controllers\Admin\Question\QuestionController::class, 'create'])->name('create.question');
    Route::post('/store/Question', [App\Http\Controllers\Admin\Question\QuestionController::class, 'store'])->name('store.question');

    //ajax get section
    Route::get('get/section/{quiz_id}', [App\Http\Controllers\Admin\Question\QuestionController::class, 'getSection']);

});

//page not found for API
Route::get('page/not/found', [App\Http\Controllers\Api\RouteHandlingController::class, 'index'])->name('route.handling');


