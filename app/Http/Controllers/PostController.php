<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index(){
        // Select * from posts
        $postsFromDB = Post::all();
        return view('posts.index', ['posts' => $postsFromDB]);
    }
    public function show(Post $post) // type hinting
    {
        return view('posts.show', ['posts' => $post]);
    }
    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
            'post_creator' => ['required', 'exists:users,id']
        ]);
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator
        ]);
        return to_route('posts.index');
    }

    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', ['users' => $users, 'post' => $post]);
    }

    public function update($postId)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:10'],
            'post_creator' => ['required', 'exists:users,id']
        ]);
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        $singlePostFromDB = Post::find($postId);
        $singlePostFromDB->update([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator
        ]);
        return to_route('posts.show', $postId);
    }

    public function destroy($postId)
    {
        $post = Post::find($postId);
        $post->delete();
        // 1- delete the post from the database


        // 2- redirect to posts.index
        return to_route('posts.index');
    }
}
