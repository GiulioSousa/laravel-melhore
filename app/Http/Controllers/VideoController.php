<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            'style' => 'css/panel/style.css',
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
        $validator = $this->verifyData($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->except('_token');
        $data['url'] = $this->convertUrl($request);
        $data['tag'] = $request->tag;  
        
        $client = User::find($request->user_id);
        $client->videos()->create($data);

        return redirect()
            ->route('client-info.index', $request->user_id)
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

        return view('video.edit')->with([
            'title' => 'Editar video - Painel administrativo | Melhore',
            'home' => 'panel.index',
            'style' => 'css/panel/style.css',
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
        $validator = $this->verifyData($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

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

    public function verifyData(Request $request)
    {
        return Validator::make($request->except('_token'), [
            'title' => 'required|regex:/^[a-zA-Z0-9\s]+$/',
            'description' => 'required|regex:/^[a-zA-Z0-9\s\d\/\-\_\.\:\=\?]+$/',
            'url' => ['required', 'url', 'regex:/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)(?:[\w-]{11})/']
        ],
        [
            'title.required' => 'Este campo é obrigatório',
            'title.regex' => 'Este campo só pode conter letras e números',
            'description.required' => 'Este campo é obrigatório',
            'description.regex' => 'Este campo não pode conter caracteres especiais',
            'url.required' => 'Este campo é obrigatório',
            'url.regex' => 'A URL deve ser de um vídeo do YouTube.',
        ]);
    }

    public function convertUrl(Request $request)
    {
        $url = $request->url;
        $pattern = '/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)([\w-]{11})/i';

        preg_match($pattern, $url, $match);

        if (is_array($match) && isset($match[1])) {
            return $match[1];
        } else {
            return null;
        }

        return $match[1];
    }

    public function validateData($validator)
    {
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }
}
