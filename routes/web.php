<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

//load landing page
Route::get('/', function () {
    return view('welcome');
});

//user authentication routes
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin authentication routes
Route::get('admin', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin', [App\Http\Controllers\Admin\Auth\LoginController::class, 'adminLogin']);

//admin dashboard routes
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('admin/home', [App\Http\Controllers\Admin\AdminHomeController::class, 'index'])->name('admin.home');

    //Quiz Routes (crud operations)
    Route::get('/create/quiz', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'create'])->name('create.quiz');
    Route::post('/store/quiz', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'store'])->name('store.quiz');
    Route::get('/all/quizzes', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'index'])->name('all.quizzes');
    Route::get('/edit/quiz/{id}', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'edit'])->name('edit.quiz');
    Route::post('/update/quiz/{id}', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'update'])->name('update.quiz');
    Route::get('/delete/quiz/{id}', [App\Http\Controllers\Admin\Quiz\QuizController::class, 'destroy'])->name('delete.quiz');

    //Sections Routes
    Route::get('/create/section', [App\Http\Controllers\Admin\Section\SectionController::class, 'create'])->name('create.section');
    Route::post('/store/section', [App\Http\Controllers\Admin\Section\SectionController::class, 'store'])->name('store.section');

    //ajax get sections
    Route::get('get/section/{quiz_id}', [App\Http\Controllers\Admin\Question\QuestionController::class, 'getSection']);

    //Questions Routes
    Route::get('/create/Question', [App\Http\Controllers\Admin\Question\QuestionController::class, 'create'])->name('create.question');
    Route::post('/store/Question', [App\Http\Controllers\Admin\Question\QuestionController::class, 'store'])->name('store.question');
});

//Extra routes
//Exception handling/middleware authenticate (page not found for API)
Route::get('page/not/found', [App\Http\Controllers\Api\RouteHandlingController::class, 'index'])->name('route.handling');


