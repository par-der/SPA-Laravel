<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $posts = PostResource::collection($posts)->resolve();
        return inertia('Post/index', compact('posts'));
    }

    public function create()
    {
        return inertia('Post/create');
    }

    public function show(Post $post)
    {
        return inertia('Post/show', compact('post'));
    }

    public function store(StoreRequest $request)
    {
        //изучить что это!!!!
        //получение с формы данных
        Post::create($request->validated());
        return redirect()->route('post.index');
    }

    public function edit(Post $post)
    {
        return inertia('Post/edit', compact('post'));
    }

    public function update(Post $post, UpdateRequest $request)
    {
        $post->update($request->validated());
        return redirect()->route('post.index');
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->route('post.index');
    }
}
