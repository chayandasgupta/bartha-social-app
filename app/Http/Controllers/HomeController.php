<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostCollection;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return inertia('Home');
        // $nextCursor = $request->input('next_cursor') ?? null;

        // $allPosts = Post::select([
        //     'id',
        //     'description',
        //     'user_id',
        //     'view_count',
        //     'created_at'
        // ])->withCount('comments')
        // ->with(['user:id,name,user_name', 'user.media'])
        // ->with('media')
        // ->cursorPaginate(15, ['*'], 'cursor', $nextCursor);

        // $posts = PostCollection::make($allPosts);

        // if ($request->wantsJson()) {
        //     return $posts;
        // }

        // return view('index', compact('posts'));
    }

}