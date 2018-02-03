<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getPosts()
    {
        return Post::where('user_id', Auth::id())->get();
    }

    public function createPost(Request $request)
    {
        $this->validatePostData($request);

        if ($categoryId = $request->input('category_id')) {
            Category::findOrFail($categoryId);
        }

        $post = new Post($request->all());
        $post->user_id = Auth::id();
        $post->save();

        return $post;
    }

    public function showPost($id)
    {
        $post = Post::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        return $post;
    }

    public function updatePost($id, Request $request)
    {
        $this->validatePostData($request);

        $post = Post::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $post->fill($request->all());
        $post->save();

        return $post;
    }

    public function deletePost($id)
    {
        $post = Post::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $post->delete();

        return ['message' => 'Post deleted'];
    }

    private function validatePostData(Request $request)
    {
        Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
            'category_id' => 'integer|nullable',
        ])->validate();
    }
}