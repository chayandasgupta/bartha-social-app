<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $nextCursor = $request->input('next_cursor') ?? null;
        $posts = Post::select([
            'id',
            'description',
            'uuid',
            'user_id'
        ])->withCount('comments')
            ->with(['user:id,name,user_name,uuid,image', 'user.media'])
            ->orderByDesc('id')
            ->cursorPaginate(15, ['*'], 'cursor', $nextCursor);

        if ($request->wantsJson()) {
            return $posts;
        }

        return view('index', compact('posts'));
    }
}
