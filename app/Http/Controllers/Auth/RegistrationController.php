<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
  public function index()
  {
    return view('frontend.registration');
  }

  public function register(UserRequest $request)
  { 
    $requestedUserData             = $request->validated();
    $requestedUserData['password'] = Hash::make($request->password);
    User::create($requestedUserData);
    
    flash('Registration successfully.');
    return redirect()->route('login');
  }
}