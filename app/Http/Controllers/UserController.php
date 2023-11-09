<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
class UserController extends Controller
{       
    public function getUserData($userName)
    {
        return User::where("user_name", $userName)->first(['id','name', 'user_name','email']);
    }
    public function showProfile($userName)
    {
        $user = $this->getUserData($userName);
        
        return view('frontend.user.profile', compact('user'));
    }

    public function editProfile($userName)
    {
        $user = $this->getUserData($userName);
        return view('frontend.user.edit-profile', compact('user'));
        
    }

    public function updateProfile(Request $request, $id)
    {
        $requestedUserData = $request->only('name','user_name','password', 'email');

        // Check if the password is provided
        if ($request->has('password')) {
            $requestedUserData['password'] = Hash::make($request->password);
        }
        
        User::where('id', $id)->update($requestedUserData);
        
        flash('Profile updated successfully.');
        return back();
    }
}