<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

// User routes
// Route::controller(UserController::class)->group(function () {
//     Route::get('/{user_name}', 'UserController@showProfile')
//         ->name('profile.show');

//     // Edit Profile
//     Route::get('/{user_name}/edit', 'UserController@editProfile')
//         ->name('profile.edit');

//     // Update Profile
//     Route::put('/{id}', 'UserController@updateProfile')
//         ->name('profile.update');
// });

// Route::controller(UserController::class)->group(function () {
//     Route::get('/{user_name}', 'showProfile')->name('profile.show');
//     Route::get('/{user_name}/profile', 'editProfile')->name('profile.edit');
//     Route::put('/user/{id}', 'updateProfile')->name('profile.update');
// });

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


require __DIR__ . '/auth.php';
