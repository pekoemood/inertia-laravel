<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['string', 'required'],
            'email' => ['email', 'required', 'unique:users'],
            'password' => ['required','confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Auth::login($user);
        return redirect()->route('welcome');
    }

    public function login(Request $request): RedirectResponse
    {
        $params = $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required'],
        ]);
        if (! Auth::attempt($params)) {
            return redirect()->back()->withErrors([
                'email' => 'メールアドレスまたはパスワードが正しくありません。'
            ]);
        }

        return redirect()->route('welcome');
    }
}
