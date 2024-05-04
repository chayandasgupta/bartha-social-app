<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', HomeController::class)->name('home');
    // Route::get('/fetch-posts', [HomeController::class, 'fetchPost'])->name('fetch.post');

    Route::prefix('/profile')->group(function () {
        Route::get('/{id}', [UserController::class, 'showProfile'])
            ->name('profile.show');
        Route::get('/{id}/edit',  [UserController::class, 'editProfile'])
            ->name('profile.edit');
        Route::put('/{id}', [UserController::class, 'updateProfile'])
            ->name('profile.update');
    });

    // Post routes
    Route::resource('post', PostController::class);
    Route::resource('comments', CommentController::class);
});


require __DIR__ . '/auth.php';
