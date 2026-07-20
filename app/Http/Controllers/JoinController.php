<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $userData = User::create([
        //     'name' => 'John Doe',
        //     'email' => 'john.doe@example.com',
        //     'password' => bcrypt('password'),
        // ]);

        // $userData->image()->create([
        //     'url' => 'user_image_john_doe.jpg',
        // ]);

        // return $userData;

        // $blogPosts = new Blog;

        // $blogPosts->title = 'My First Blog Post';
        // $blogPosts->save();

        // $blogPosts->image()->create([
        //     'url' => 'blog_image_1.jpg',
        // ]);

        // return response()->json($blogPosts);

        // $blogImage = Blog::with('image')->findOrFail(3);

        // return response()->json($blogImage);

        // $postData = Post::create([
        //     'title' => 'My third Post',
        //     'post' => 'This is the content of my third post.',
        // ]);

        // $postData->comments()->create([
        //     'comment' => 'This is a comment on the third post.',
        // ]);

        // return response()->json($postData);

        // $blogData = Blog::create([
        //     'title' => 'My First Blog Post',
        // ]);

        // $blogData->comments()->create([
        //     'comment' => 'This is a comment on the first blog post.',
        // ]);

        // return response()->json($blogData);

        // $blogData = Post::with('comments')->findOrFail(1);

        // return response()->json($blogData);

        $users = User::all();

        return response()->json($users);
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
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
