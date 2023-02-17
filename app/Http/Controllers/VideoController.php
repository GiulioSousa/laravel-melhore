<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
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
        $user = Auth::user();

        return view('video.create')->with([
            'title' => 'Novo video - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/style.css',
            'user' => $user,
            'route' => 'video.store',
            'arrayData' => [
                'user_id' => $request->id,
                'tag' => $request->tag
            ],
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
        $data['tag'] = $request->tag;      
        
        $client = User::find($request->user_id);
        $client->videos()->create($data);

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
    public function edit(Request $request, Video $video)
    {
        $video = Video::find($request->id);
        $user = Auth::user();
        // dd($video);

        return view('video.edit')->with([
            'title' => 'Editar video - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/style.css',
            'user' => $user,
            'route' => 'video.update',
            'video' => $video,
            'arrayData' => [
                'id' => $video['id']
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
    public function update(Video $video, Request $request, $id)
    {
        $video = Video::find($id);
        $video->update($request->except('_token'));

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
        $video = Video::find($id);
        $video->delete();
        return to_route('panel.index');
    }
}
