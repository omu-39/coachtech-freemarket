<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * ログイン処理
     * 
     * @param LoginRequest $request
     * @return RedirectResponse 商品一覧画面
     */
    public function login(LoginRequest $request)
    {
        Auth::attempt($request->only(['email', 'password']));

        if (!Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('item.index'));
    }
}

