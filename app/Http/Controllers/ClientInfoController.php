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
        $user = Auth::user();
        $client = User::find($id);
        $videos = Video::where('users_id', $id)->get();
        $metrics = Metric::where('users_id', $id)->get();
        $diagnostics = Diagnostic::where('users_id', $id)->get();
        $videosHighlight = $videos->where('tag', 'highlight');
        $videosWhatDo = $videos->where('tag', 'whatDo');
        $videosHowDo = $videos->where('tag', 'howDo');
        $videosTeam = $videos->where('tag', 'team');

        return view('client-info.index')
            ->with([
                'style' => 'css/panel/style.css',
                'clientName' => $client->login,
                'clientId' => $client->id,
                'user' => $user,
                'home' => 'panel.index',
                'videosHighlight' => $videosHighlight,
                'metrics' => $metrics,
                'diagnostics' => $diagnostics,
                'videosWhatDo' => $videosWhatDo,
                'videosHowDo' => $videosHowDo,
                'videosTeam' => $videosTeam,
                'id' => $id
            ]);
    }
}
