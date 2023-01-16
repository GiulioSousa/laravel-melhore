<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // dd($user);

        return view('account.index')->with([
            'title' => 'Informações da conta | Melhore',
            'style' => 'css/style.css',
            'user' => $user,
            'home' => 'panel.index'
        ]);
    }

    public function edit(Request $request)
    {
        return view('account.edit')->with([
            'title' => 'Editar conta | Melhore',
            'style' => 'css/style.css',
            'user' => Auth::user(),
            'home' => 'panel.index'
        ]);
    }

    public function update(Request $request)
    {
        dd($request->all());
    }
}
