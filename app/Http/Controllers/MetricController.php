<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use App\Models\User;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MetricController extends Controller
{
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $login = Auth::user()->login;

        return view('metric.create')->with([
            'title' => 'Nova Métrica - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/style.css',
            'login' => $login,
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
        $client->metrics()->create($data);

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
    public function edit(Request $request, Metric $metric)
    {
        $metric = Metric::find($request->id);
        $login = Auth::user()->login;

        return view('metric.edit')->with([
            'title' => 'Editar métrica - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/style.css',
            'login' => $login,
            'metric' => $metric
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
        $metric = Metric::find($id);
        $metric->update($request->except('_token'));

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
        $metric = Metric::find($id);
        $metric->delete();
        return to_route('panel.index');
    }
}
