<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
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
        $this->validateData($request);

        $data = $request->except('_token');
        $data['url'] = $this->convertUrl($request);
        $data['tag'] = $request->tag;  
        
        $client = User::find($request->user_id);
        $client->videos()->create($data);

        return to_route('client-info.index', $request->user_id)
        ->with('message.success', 'Video adicionado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
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
        
        $video->update($request->except('_token', '_method'));
        
        return to_route('client-info.index', $video->users_id)
            ->with('message.success', 'Video atualizado com sucesso');
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

        return to_route('client-info.index', $video->users_id)
            ->with('message.success', 'Video excluído com sucesso');
    }

    public function validateData(Request $request)
    {
        $request->validate([
            'title' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'required|regex:/^[a-zA-Z0-9\s\d\/\-\_\.\:\=\?]+$/',
            'url' => 'required|regex:/^[a-zA-Z0-9\s\d\/\-\_\.\:\=\?]+$/'
        ],
        [
            'title.required' => 'Este campo é obrigatório',
            'title.regex' => 'Este campo só pode conter letras e números',
            'description.required' => 'Este campo é obrigatório',
            'description.regex' => 'Este campo não pode conter caracteres especiais',
            'url.required' => 'Este campo é obrigatório',
            'url.regex' => 'A URL deve ser válida e conter um ID de vídeo do YouTube.',
        ]);
    }

    public function convertUrl(Request $request)
    {
        $url = $request->url;
        $pattern = '/(?:\w*:\/\/)?(?:www\.)?youtu(?:\.be|be\.com)\/(?:.*v(?:\/|=)|(?:.*\/)?)([\w\-]+)(?:.*)/i';

        preg_match($pattern, $url, $match);

        return $match[1];
    }    
}
