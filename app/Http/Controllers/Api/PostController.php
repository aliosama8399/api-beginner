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


}
