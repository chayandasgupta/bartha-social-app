<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $post = auth()->user()->posts()->create($request->validated());

        if ($request->hasFile('image')) {
            $post->addMedia($request->image)
                ->toMediaCollection('posts');
        }

        if ($post) {
            flash('Post created successfully');
        } else {
            flash()->addWarning('Something went wrong.');
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->update(['view_count' => $post->view_count + 1]);
        $post->load([
            "user:id,name,user_name",
            'comments:id,description,user_id,post_id,created_at',
        ])->loadCount(['comments']);
        return view('frontend.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('frontend.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $uuid)
    {
        $postData = $request->validated();
        $postUpdate = Post::where('id', $uuid)->update($postData);

        if ($postUpdate) {
            flash('Post updated successfully');
        } else {
            flash('Post updated failed');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        flash('Post has been deleted successfully');

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}