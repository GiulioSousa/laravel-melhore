<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DiagnosticController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        return view('diagnostic.create')->with([
            'title' => 'Novo diagnóstico - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/panel/style.css',
            'user' => $user,
            'route' => 'diagnostic.store',
            'arrayData' => [
                'user_id' => $request->id
            ]
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
        $validator = $this->verifyData($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('_token');
               
        $client = User::find($request->user_id);
        $client->diagnostics()->create($data);

        return to_route('client-info.index', $request->user_id)
            ->with('message.success', 'Diagnóstico adicionado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Diagnostic $diagnostic)
    {
        $diagnostic = Diagnostic::find($request->id);
        $user = Auth::user();

        return view('diagnostic.edit')->with([
            'title' => 'Editar diagnóstico - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/panel/style.css',
            'user' => $user,
            'diagnostic' => $diagnostic,
            'route' => 'diagnostic.update',
            'arrayData' => [
                'id' => $diagnostic->id
            ]
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
        $validator = $this->verifyData($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $diagnostic = Diagnostic::find($id);
        $diagnostic->update($request->except('_token'));

        return to_route('client-info.index', $diagnostic->users_id)
            ->with('message.success', 'Diagnóstico atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnostic = Diagnostic::find($id);
        $diagnostic->delete();

        return to_route('client-info.index', $diagnostic->users_id)
            ->with('message.success', 'Diagnóstico excluído com sucesso.');
    }

    public function verifyData(Request $request)
    {
        return Validator::make($request->except('_token'), [
            'diagnostic_text'=> [
                'required', 
                'string',
                'regex:/^[a-zA-Z0-9À-úçÇ\s.,:;?!]*$/'
            ]
        ]);
    }
}
