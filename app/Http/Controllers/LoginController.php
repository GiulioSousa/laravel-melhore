<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController
{
    public function autenticar(Request $request)
    {
        if (!Auth::attempt($request->except('_token'))) {
            return redirect()->back()->withErrors('Usuário ou senha inválidos');
        }

        if (Auth::user()->admin_mode) {
            return to_route('panel.index');
        }

        return to_route('client-area.index');

    }

    public function index()
    {
        return view('login.index')
        ->with('title', 'Login - Área do cliente | Melhore')
        ->with('style', 'css/login/login.css');
    }

    public function destroy()
    {
        Auth::logout();

        return to_route('login.index');
    }
}
