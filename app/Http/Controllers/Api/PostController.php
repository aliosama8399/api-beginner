<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResources;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);

        }
        $post = Post::create($request->all());
        if ($post) {
            return $this->apiResponse(new PostResources ($post), 'Post saved in database!', 201);
        }
        return $this->apiResponse(null, 'Not saved in database!', 400);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->apiResponse(null, $validator->errors(), 400);

        }
        $post = Post::find($id);
        if (!$post) {
            return $this->apiResponse(null, 'Not Found!', 404);
        }

        $post->update($request->all());
        if ($post) {
            return $this->apiResponse(new PostResources ($post), 'Post update in database!', 201);
        }
        return $this->apiResponse(null, 'Not updated in database!', 400);

    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            return $this->apiResponse(null, 'Not Found!', 404);
        }

        $post->delete($id);
        if ($post) {
            return $this->apiResponse(null, 'Post delete in database!', 200);
        }
    }
}
