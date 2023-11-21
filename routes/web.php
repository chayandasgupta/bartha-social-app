<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
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

Route::get('/', function () {
    if (Auth::check()) {
        return view('index');
    } else {
        return redirect('login');
    }
})->name('home');


// Authentication routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/registration', [RegistrationController::class, 'index'])->name('registration');
Route::post('/store', [RegistrationController::class, 'register'])->name('register.store');


// User routes
Route::controller(UserController::class)->group(function () {
    Route::get('/{user_name}', 'showProfile')->name('profile.show');
    Route::get('/{user_name}/profile', 'editProfile')->name('profile.edit');
    Route::put('/user/{id}', 'updateProfile')->name('profile.update');
});


// Post routes
Route::resource('post', PostController::class)->except([
    'index'
]);;
