<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\Metric;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $login = $user->login;
        $videos = Video::where('users_id', $user->id)->get();
        $metrics = Metric::where('users_id', $user->id)->get();
        $diagnostics = Diagnostic::where('users_id', $user->id)->get();
        $videosHighlight = $videos->where('tag', 'highlight');
        $videosWhatDo = $videos->where('tag', 'whatDo');
        $videosHowDo = $videos->where('tag', 'howDo');
        $videosTeam = $videos->where('tag', 'team');
        
        return view('client-area.index')->with([
            'title' => 'home - Área do cliente | Melhore',
            'style' => 'css/style.css',
            'home' => 'client-area.index',
            'login' => $login,
            'videosHighlight' => $videosHighlight,
            'metrics' => $metrics,
            'diagnostics' => $diagnostics,
            'videosWhatDo' => $videosWhatDo,
            'videosHowDo' => $videosHowDo,
            'videosTeam' => $videosTeam,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
