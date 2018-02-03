<?php

namespace App\Http\Controllers;

use App\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
