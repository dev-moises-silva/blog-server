<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'content' => 'required|string|max:900',
        ]);

        $data['user_id'] = $user->id;

        $post = Post::create($data);

        return new PostResource($post);
    }

    public function index(Request $request)
    {
        $posts = Post::latest()->get();

        return PostResource::collection($posts);
    }

    public function delete(Request $request, Post $post)
    {
        if ($request->user()->id == $post->user_id)
        {
            $post->delete();
        }
        else
        {
            abort(403, 'You do not have permission to perform this action.');
        }
    }
}
