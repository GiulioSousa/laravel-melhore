<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoFormRequest;
use App\Models\Video;
use App\Repositories\VideoRepository;
use App\Traits\ConvertUrlTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    use ConvertUrlTrait;

    public function __construct(private VideoRepository $videoRepository)
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
     * @param  \App\Http\Requests\VideoFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VideoFormRequest $request)
    {
        $id = $request->user_id;
        $data = $request->except('_token');
        $data['url'] = $this->extractYoutubeId($request);
        $data['tag'] = $request->tag;
        
        $this->videoRepository->create($id, $data);

        return redirect()
            ->route('client-info.index', $id)
            ->with('message.success', 'Video adicionado com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Video $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Video $video)
    {
        $user = Auth::user();
        $video = $this->videoRepository->findVideo($request->id);
        $video->url = $this->generateTemplateUrl($video->url);

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
    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        $users_id = $this->videoRepository->update($id, $data);
        
        return to_route('client-info.index', $users_id)
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
        $users_id = $this->videoRepository->delete($id);

        return to_route('client-info.index', $users_id)
            ->with('message.success', 'Video excluído com sucesso');
    }
}
