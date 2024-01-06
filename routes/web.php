<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('/profile')->group(function () {
    // Show Profile
    Route::get('/{id}', [UserController::class, 'showProfile'])
        ->name('profile.show');

    // Edit Profile
    Route::get('/{id}/edit',  [UserController::class, 'editProfile'])
        ->name('profile.edit');

    // Update Profile
    Route::put('/{id}', [UserController::class, 'updateProfile'])
        ->name('profile.update');
});

// Post routes
Route::resource('post', PostController::class);
Route::resource('comments', CommentController::class);


require __DIR__ . '/auth.php';
