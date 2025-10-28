<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Post::all()
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Post no encontrado'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }
}
