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
        $token = UserToken::where('user_id', Auth::id())->first();

        return view('home', [
            'userToken' => $token ? $token->token : null,
        ]);
    }

    /**
     * Генерация случайного токена
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createToken()
    {
        $userId = Auth::id();
        $secret = preg_replace('~[^A-Za-z0-9]~', '', $userId . encrypt(random_bytes(64)));

        $token = UserToken::where('user_id', Auth::id())->first();

        // Если токен существует, обновляем его, иначе создаем новый
        $token = $token ? $token : new UserToken();
        $token->token = $secret;
        $token->user_id = $userId;
        $token->save();

        return redirect('home');
    }
}
