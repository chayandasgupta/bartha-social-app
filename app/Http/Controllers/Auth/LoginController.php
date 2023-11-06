<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController
{
  public function index()
  {
    return view('frontend.login');
  }

  public function login()
  {
  }
}