<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResources;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponceTrait;

    public function index()
    {
        $posts = PostResources::collection(Post::get());
        return $this->apiResponse($posts, 'OK!', 200);
    }

    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return $this->apiResponse(new PostResources ($post), 'OK!', 200);
        }
        return $this->apiResponse(null, 'Not Found!', 404);

    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        if ($post) {
            return $this->apiResponse(new PostResources ($post), 'Post saved in database!', 201);
        }
        return $this->apiResponse(null, 'Not saved in database!', 400);

    }

}
