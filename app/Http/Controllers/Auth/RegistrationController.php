<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController
{
  public function index()
  {
    return view('frontend.registration');
  }

  public function register(UserRequest $request)
  {
    User::create($request->validate());
    $credentials = $request->only('email', 'password');
    Auth::attempt($credentials);
    $request->session()->regenerate();
    return redirect()->route('dashboard')
      ->withSuccess('You have successfully registered & logged in!');
  }
}
