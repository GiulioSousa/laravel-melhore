<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MetricController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        return view('metric.create')->with([
            'title' => 'Nova Métrica - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/panel/style.css',
            'user' => $user,
            'route' => 'metric.store',
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
        // dd($request->all());
        $validator = $this->verifyData($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('_token');
               
        $client = User::find($request->user_id);
        $client->metrics()->create($data);

        return to_route('client-info.index', $request->user_id)
            ->with('message.success', 'Métrica criada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Metric $metric)
    {
        $metric = Metric::find($request->id);
        $user = Auth::user();

        return view('metric.edit')->with([
            'title' => 'Editar métrica - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/panel/style.css',
            'user' => $user,
            'metric' => $metric,
            'route' => 'metric.update',
            'arrayData' => [
                'id' => $metric->id
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
    public function update(Metric $metric, Request $request, $id)
    {
        $validator = $this->verifyData($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $metric = Metric::find($id);
        $metric->update($request->except('_token'));

        return to_route('client-info.index', $metric->users_id)
            ->with('message.success', 'Métrica atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $metric = Metric::find($id);
        $metric->delete();

        return to_route('client-info.index', $metric->users_id)
            ->with('message.success', 'Métrica excluída com sucesso.');
    }

    public function verifyData(Request $request)
    {
        return Validator::make($request->except('_token'), [
            'date' => 'required|date',
            'metric_data' => 'required|numeric'
        ],
        [
            'date.required' => 'Este campo é obrigatório',
            'date.date' => 'Formato de data incorreto',
            'metric_data.required' => 'Este campo é obrigatório',
            'metric_data.numeric' => 'Somente números são permitidos neste campo'
        ]
    );
    }
}
