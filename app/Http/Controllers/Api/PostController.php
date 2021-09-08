<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ApiResponceTrait;

    public function index()
    {
        $posts = Post::get();
        return $this->apiResponse($posts, 'OK!', 200);
    }

    public function show($id)
    {
        $post = Post::find($id);
        if ($post) {
            return $this->apiResponse($post, 'OK!', 200);
        }
        return $this->apiResponse(null, 'Not Found!', 404);

    }

}
