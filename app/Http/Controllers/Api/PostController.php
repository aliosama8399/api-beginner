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
//        $posts = Post::get();
        $posts =  PostResources::collection(Post::get());

        return $this->apiResponse($posts, 'OK!', 200);
    }

    public function show($id)
    {
        $post = new PostResources (Post::find($id));
        if ($post) {
            return $this->apiResponse($post, 'OK!', 200);
        }
        return $this->apiResponse(null, 'Not Found!', 404);

    }

}
