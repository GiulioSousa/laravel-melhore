<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\Metric;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class ClientAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $videos = Video::where('users_id', $user->id)->get();
        $metrics = Metric::where('users_id', $user->id)->get();
        $diagnostics = Diagnostic::where('users_id', $user->id)->get();
        $videosHighlight = $videos->where('tag', 'highlight');
        $videosWhatDo = $videos->where('tag', 'whatDo');
        $videosHowDo = $videos->where('tag', 'howDo');
        $videosTeam = $videos->where('tag', 'team');
        
        return view('client-area.index')->with([
            'title' => 'home - Área do cliente | Melhore',
            'style' => 'css/panel/style.css',
            'home' => 'client-area.index',
            'user' => $user,
            'videosHighlight' => $videosHighlight,
            'metrics' => $metrics,
            'diagnostics' => $diagnostics,
            'videosWhatDo' => $videosWhatDo,
            'videosHowDo' => $videosHowDo,
            'videosTeam' => $videosTeam,
        ]);
    }
}
