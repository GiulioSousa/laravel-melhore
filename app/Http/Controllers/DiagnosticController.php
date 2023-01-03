<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\Metric;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user()->login;

        return view('diagnostic.create')->with([
            'title' => 'Novo diagnóstico - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/style.css',
            'user' => $user,
            'user_id' => $request->id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
               
        $client = User::find($request->user_id);
        $client->diagnostics()->create($data);

        return to_route('client-info.index', $request->user_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Diagnostic $diagnostic)
    {
        $diagnostic = Diagnostic::find($request->id);
        $user = Auth::user()->login;

        return view('diagnostic.edit')->with([
            'title' => 'Editar diagnóstico - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/style.css',
            'user' => $user,
            'diagnostic' => $diagnostic
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Diagnostic $diagnostic, Request $request, $id)
    {
        $diagnostic = Diagnostic::find($id);
        $diagnostic->update($request->except('_token'));

        return to_route('panel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
