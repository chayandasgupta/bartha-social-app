<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function getUserData($id)
    {
        return DB::table('users')
            ->where("uuid", $id)
            ->first(['id', 'uuid', 'name', 'user_name', 'email', 'bio']);
    }

    public function showProfile($id)
    {
        $user = $this->getUserData($id);
        return view('frontend.user.profile', compact('user'));
    }

    public function editProfile($id)
    {
        $user = $this->getUserData($id);
        return view('frontend.user.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $requestedUserData = $request->only('name', 'user_name', 'password', 'email', 'bio');

        // Check if the password is provided
        if ($request->has('password')) {
            $requestedUserData['password'] = Hash::make($request->password);
        }

        $userUpdate = DB::table('users')
            ->where('uuid', $id)
            ->update($requestedUserData);

        if (!$userUpdate) {
            flash('Profile updating failed.');
        } else {
            flash('Profile updated successfully.');
        }

        return back();
    }
}
