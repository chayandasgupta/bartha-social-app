<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Inertia\Inertia;

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

// Route::middleware(['auth'])->group(function () {
//     Route::get('/', HomeController::class)->name('home');

//     Route::prefix('/profile')->group(function () {
//         Route::get('/{id}', [UserController::class, 'showProfile'])
//             ->name('profile.show');
//         Route::get('/{id}/edit',  [UserController::class, 'editProfile'])
//             ->name('profile.edit');
//         Route::put('/{id}', [UserController::class, 'updateProfile'])
//             ->name('profile.update');
//     });

//     // Post routes
//     Route::resource('post', PostController::class);
//     Route::resource('comments', CommentController::class);
// });


// require __DIR__ . '/auth.php';

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';