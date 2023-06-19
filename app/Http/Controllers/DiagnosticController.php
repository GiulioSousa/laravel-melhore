<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiagnosticFormRequest;
use App\Models\Diagnostic;
use App\Repositories\DiagnosticRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosticController extends Controller
{
    public function __construct(private DiagnosticRepository $diagnosticRepository)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
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
     * @param  \App\Http\Requests\DiagnosticFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiagnosticFormRequest $request)
    {
        $data = $request->except('_token');
        $id = $request->user_id;

        $this->diagnosticRepository->create($id, $data);
               
        return to_route('client-info.index', $id)
            ->with('message.success', 'Diagnóstico adicionado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param \App\Models\Diagnostic $diagnostic
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Diagnostic $diagnostic)
    {
        $user = Auth::user();
        $diagnostic = $this->diagnosticRepository->findDiagnostic($request->id);

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
     * @param  \App\Http\Requests\DiagnosticFormRequest  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiagnosticFormRequest $request, $id)
    {
        $users_id = $this->diagnosticRepository->update($id, $request->except('_token'));

        return to_route('client-info.index', $users_id)
            ->with('message.success', 'Diagnóstico atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $users_id = $this->diagnosticRepository->delete($id);

        return to_route('client-info.index', $users_id)
            ->with('message.success', 'Diagnóstico excluído com sucesso.');
    }
}
