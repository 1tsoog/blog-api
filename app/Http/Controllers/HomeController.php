<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token = Auth::user()->api_token;

        return view('home', [
            'userToken' => $token ? $token : null,
        ]);
    }

    /**
     * Генерация случайного токена
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createToken()
    {
        $user = Auth::user();
        $user->api_token = preg_replace('~[^A-Za-z0-9]~', '', $user->id . encrypt(random_bytes(32)));
        $user->save();

        return redirect('home');
    }

    public function apiTestPage()
    {
        return view('apitest', [
            'apiToken' =>  Auth::user()->api_token
        ]);
    }

    public function apiTestCreate(Request $request)
    {
        Validator::make($request->all(), [
            'categoryTitle' => 'required|string|max:255',
            'categoryDescription' => 'required|string|max:1000',
            'postTitle' => 'required|string|max:255',
            'postDescription' => 'required|string|max:1000',
        ])->validate();

        $category = new Category([
            'title' => $request->input('categoryTitle'),
            'description' => $request->input('categoryDescription'),
        ]);
        $category->save();

        $post = new Post([
            'title' => $request->input('postTitle'),
            'content' => $request->input('postDescription'),
        ]);
        $post->user_id = Auth::id();
        $post->save();

        return response()->json([
            'cateogry' => $category,
            'post' => $post,
        ]);
    }
}
