<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        if (!Auth()->check()) {
            return redirect()->route('login');
        }

        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select(
                'posts.uuid',
                'posts.description',
                'posts.user_id',
                'users.name',
                'users.user_name',
                'users.uuid as user_uuid',
                DB::raw('(SELECT COUNT(*) FROM comments WHERE post_id = posts.id) as comment_count')
            )
            ->orderBy('posts.id', 'desc')
            ->get();

        return view('index', compact('posts'));
    }
}
