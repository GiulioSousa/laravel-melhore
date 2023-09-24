<?php

namespace App\Http\Controllers;

use App\Http\Requests\MetricFormRequest;
use App\Models\Metric;
use App\Repositories\MetricRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetricController extends Controller
{
    public function __construct(private MetricRepository $metricRepository)
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
        $id = $request->id;

        return view('metric.create')->with([
            'title' => 'Nova Métrica - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/panel/style.css',
            'user' => $user,
            'route' => 'metric.store',
            'arrayData' => [
                'user_id' => $id
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MetricFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MetricFormRequest $request)
    {
        $data = $request->except('_token');
        $id = $request->user_id;

        $this->metricRepository->create($id, $data);

        return to_route('client-info.index', $id)
            ->with('message.success', 'Métrica adicionada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Metric $metric
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Metric $metric)
    {
        $user = Auth::user();
        $metric = $this->metricRepository->findMetric($request->id);
        
        $dateArray = explode(' ', $metric->date);
        $metric->date = $dateArray[0];

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
     * @param  \App\Http\Requests\MetricFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MetricFormRequest $request, $id)
    {
        $users_id = $this->metricRepository->update($id, $request->except('_token'));

        return to_route('client-info.index', $users_id)
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
        $users_id = $this->metricRepository->delete($id);
        
        return to_route('client-info.index', $users_id)
            ->with('message.success', 'Métrica excluída com sucesso.');
    }
}
