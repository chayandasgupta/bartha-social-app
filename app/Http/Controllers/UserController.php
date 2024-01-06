<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUserData($id)
    {
        return DB::table('users')
            ->select(
                'id',
                'uuid',
                'name',
                'user_name',
                'email',
                'bio',
                DB::raw('(SELECT COUNT(*) FROM posts WHERE user_id = users.id) as totalPosts'),
                DB::raw('(SELECT COUNT(*) FROM comments WHERE user_id = users.id) as totalComments')
            )
            ->where('users.uuid', $id)
            ->first();
    }

    public function showProfile($id)
    {
        $user = $this->getUserData($id);
        if ($user) {
            $userPosts = DB::table('posts')
                ->select(
                    'posts.*',
                    DB::raw('(SELECT COUNT(*) FROM comments WHERE post_id = posts.id) as comment_count')
                )
                ->orderBy('id', 'desc')
                ->where('user_id', $user->id)
                ->get();

            $user->posts = $userPosts;
        }

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
