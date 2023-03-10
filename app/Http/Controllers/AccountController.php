<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return view('account.index')->with([
            'title' => 'Informações da conta | Melhore',
            'style' => 'css/panel/style.css',
            'user' => $user,
            'home' => 'panel.index'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        return view('account.create')->with([
            'title' => 'Novo cliente - Painel Administrativo | Melhore',
            'style' => 'css/style.css',
            'user' => $user,
            'home' => 'panel.index'
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
        $data = $request->except('_token', 'confirm_password');
        $data['password'] = Hash::make($data['password']);
        $data['admin_mode'] = 0;

        $avatarPath = $this->newAvatar($request);

        $data['avatar'] = $avatarPath;
        User::create($data);

        $client = $data['login'];

        return to_route('panel.index')->with('message.success', "Cliente {$client} criado com sucesso.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('account.edit')->with([
            'title' => 'Editar conta | Melhore',
            'style' => 'css/style.css',
            'user' => Auth::user(),
            'home' => 'panel.index'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->except('_token', 'confirm_password');
        $data['password'] = Hash::make($data['password']);

        $avatarPath = $this->updateAvatar($request);

        $data['avatar'] = $avatarPath;

        $user->update($data);

        if ($user->admin_mode) {
            return to_route('panel.index')
                ->with('message.success', "Usuário {$data['login']} alterado com sucesso.");
        }

        return to_route('client-area.index')
            ->with('message.success', "Usuário {$data['login']} alterado com sucesso.");
    }

    public function newAvatar(Request $request): string
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $avatarPath = $file->storeAs(
                'img/profile-avatar',
                $request['login'] . '.' . $extension
            );
        } else {
            $profileBlank = 'img/profile-avatar/profile-blank.png';
            $avatarPath = 'img/profile-avatar/' . $request['login'] . '.png';
            Storage::copy($profileBlank, $avatarPath);
        }

        return $avatarPath;
    }

    public function updateAvatar(Request $request): string
    {
        $user = Auth::user();
        $login = $user->login;
        $currentAvatarPath = $user->avatar;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar'); //Seleciona o arquivo da request
            $extension = $file->getClientOriginalExtension();   //Armazena a extensão do arquivo

            Storage::delete($currentAvatarPath);

            $login == $request['login'] ?
                $currentAvatarPath :
                $currentAvatarPath = 'img/profile-avatar/' . $request['login'] . '.' . $extension;

            $avatarPath = $file->storeAs(
                'img/profile-avatar',
                $request['login'] . '.' . $extension
            );  // Salva o arquivo no disco com o nome do usuário

            return $avatarPath;
        } elseif ($login != $request['login']) {
            $splitPath = explode('.', $currentAvatarPath);
            $extension = end($splitPath);
            $newAvatarPath = 'img/profile-avatar/' . $request['login'] . '.' . $extension;
            Storage::move($currentAvatarPath, $newAvatarPath);

            return $newAvatarPath;
        }

        return $currentAvatarPath;
    }
}
