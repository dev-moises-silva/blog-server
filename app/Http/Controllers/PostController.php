<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'title' => 'required|string|max_digits:100',
            'content' => 'required|string|max_digits:900',
        ]);

        $data['user_id'] = $user->id;

        $post = Post::create($data);

        return response()->json($post);
    }

    public function index(Request $request)
    {
        $posts = Post::all();
        return response()->json($posts);
    }
}
