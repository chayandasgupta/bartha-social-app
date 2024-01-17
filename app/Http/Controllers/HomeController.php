<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::withUserAndComments()->get();
        return view('index', compact('posts'));
    }
}
