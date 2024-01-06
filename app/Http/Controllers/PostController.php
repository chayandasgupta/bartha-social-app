<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return view('index', compact('posts'));
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
        $postData = $request->validated();
        $postData['user_id'] = Auth::user()->id;
        $postData['uuid'] = Str::uuid();
        $post = DB::table('posts')->insert($postData);

        if ($post) {
            flash('Post created successfully');
            return back();
        } else {
            flash()->addWarning('Something went wrong.');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = DB::table('posts')->where('uuid', $id)->first();
        return view('frontend.posts.edit', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = DB::table('posts')->where('uuid', $id)->first();
        return view('frontend.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, string $id)
    {
        $postData = $request->validated();
        $postUpdate = DB::table('posts')
            ->where('uuid', $id)
            ->update($postData);

        flash('Post updated successfully');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletePost = DB::table('posts')->where('uuid', $id)->delete();
        if ($deletePost) {
            flash('Post deleted successfully');
            return back();
        } else {
            flash()->addWarning('Something went wrong.');
            return back();
        }
    }
}
