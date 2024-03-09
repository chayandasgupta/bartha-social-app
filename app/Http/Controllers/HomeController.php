<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }

    public function fetchPost(Request $request)
    {
        $nextCursor = $request->input('next_cursor') ?? null;
        $posts = Post::withUserAndComments()
            ->with('media')
            ->orderByDesc('id')
            ->cursorPaginate(15, ['*'], 'cursor', $nextCursor);

        return response()->json($posts);
    }
}
