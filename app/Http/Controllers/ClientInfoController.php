<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\Metric;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $user = Auth::user()->login;
        $client = User::find($id);
        $videos = Video::where('users_id', $id)->get();
        $metrics = Metric::where('users_id', $id)->get();
        $diagnostics = Diagnostic::where('users_id', $id)->get();
        $videosHighlight = $videos->where('tag', 'highlight');
        $videosWhatDo = $videos->where('tag', 'whatDo');
        $videosHowDo = $videos->where('tag', 'howDo');
        $videosTeam = $videos->where('tag', 'team');
        // dd($videos);

        return view('client-info.index')
            ->with([
                'style' => 'css/style.css',
                'clientName' => $client->login,
                'user' => $user,
                'home' => 'panel.index',
                'videosHighlight' => $videosHighlight,
                'metrics' => $metrics,
                'diagnostics' => $diagnostics,
                'videosWhatDo' => $videosWhatDo,
                'videosHowDo' => $videosHowDo,
                'videosTeam' => $videosTeam
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
