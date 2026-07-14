<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Post controller

        $posts = Post::with('customer')->get();

        return view('post.index', compact('posts'));
    }
}
