<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController
{
    public function autenticar(Request $request)
    {
        if (!Auth::attempt($request->except('_token'))) {
            return redirect()->back()->with('message.error', 'Usuário ou senha inválidos');
        }

        $login = Auth::user()->login;

        if (Auth::user()->admin_mode) {
            return to_route('panel.index')->with('message.success', "Bem vindo(a), {$login}");
        }

        return to_route('client-area.index')->with('message.success', "Bem vindo(a), {$login}");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.index')
        ->with('title', 'Login - Área do cliente | Melhore')
        ->with('style', 'css/login/login.css');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('login.create')
        ->with('style', 'css/login/login.css');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        $data['password'] = Hash::make($data['password']);
        
        User::create($data);
        
        return to_route('login.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Auth::logout();
    
        return to_route('login.index');
    }
}
