<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
  public function index()
  {
    return view('frontend.login');
  }

  public function login(UserRequest $request)
  { 
    $credentials = $request->validated();
    
    
    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      // return redirect()->intended('home');
      flash('Successfully loged in.');
      return redirect('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();
 
    return redirect('/');
    // return back();
  }
}