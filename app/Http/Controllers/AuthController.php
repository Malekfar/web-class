<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::where('email', '=', $request->get('email'))->first();
        if(!$user || !Hash::check($request->get('password'), $user->password))
            return redirect()->back();

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
