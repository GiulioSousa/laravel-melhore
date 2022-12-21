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

        // return to_route('painel.index');
        return view('welcome');
    }

    public function index()
    {
        return view('login.index');
    }

    public function destroy()
    {
        Auth::logout();

        return to_route('login.index');
    }
}