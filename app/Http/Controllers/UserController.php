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
            'uuid',
            'name',
            'user_name',
            'email',
            'bio',
            'image'
        )->withCount(['posts', 'comments'])
            ->where('users.uuid', $id)
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

        $userUpdate = User::where('uuid', $id)->first();
        $requestedUserData = $request->only('name', 'user_name', 'password', 'email', 'bio', 'image');

        // Check if the password is provided
        if ($request->has('password')) {
            $requestedUserData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if ($userUpdate->image) {
                Storage::delete($userUpdate->image);
            }

            $requestedUserData['image'] = $request->file('image')->store('public');
        }

        $userUpdate->update($requestedUserData);

        if (!$userUpdate) {
            flash('Profile updating failed.');
        }

        flash('Profile updated successfully.');

        return back();
    }
}
