<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getUserData($id)
    {
        $user = User::select(
            'id',
            'name',
            'user_name',
            'email',
            'bio'
        )->withCount(['posts', 'comments'])
            ->where('users.id', $id)
            ->first();
        return $user;
    }

    public function showProfile($id)
    {
        $user = $this->getUserData($id);

        if (!$user) {
            abort(404);
        }

        $userPosts = Post::withCount('comments')
            ->orderBy('id', 'desc')
            ->where('user_id', $user->id)
            ->get();

        return view('frontend.user.profile', compact('user', 'userPosts'));
    }

    public function editProfile($id)
    {
        $user = $this->getUserData($id);

        return view('frontend.user.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {

        $userUpdate = User::where('id', $id)->first();
        $requestedUserData = $request->only('name', 'user_name', 'password', 'email', 'bio', 'image');

        // Check if the password is provided
        if ($request->has('password')) {
            $requestedUserData['password'] = Hash::make($request->password);
        }


        $userUpdate->update($requestedUserData);
        if ($request->hasFile('image')) {
            if ($userUpdate->image) {
                Storage::delete($userUpdate->image);
            }

            $userUpdate->addMedia($requestedUserData['image'])
                ->toMediaCollection('users');
            // $requestedUserData['image'] = $request->file('image')->store('public');
        }


        if (!$userUpdate) {
            flash('Profile updating failed.');
        }

        flash('Profile updated successfully.');

        return back();
    }
}