<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountFormRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\AvatarTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    use AvatarTrait;
    
    public function __construct(private UserRepository $userRepository)
    {    
    }
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
     * @param \App\Http\Requests\AccountFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountFormRequest $request)
    {
        $avatarPath = $this->newAvatar($request);
        
        $data = $request->only('login', 'email', 'password');
        $data['password'] = Hash::make($data['password']);
        $data['admin_mode'] = 0;
        $data['avatar'] = $avatarPath;

        $this->userRepository->create($data);

        return to_route('panel.index')->with('message.success', "Cliente {$data['login']} criado com sucesso.");
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
     * @param  \App\Http\Requests\AccountFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(AccountFormRequest $request)
    {
        $user = Auth::user();
        $data = $request->only('login', 'email', 'password');
        $data['password'] = Hash::make($data['password']);

        $data['avatar'] = $this->updateAvatar($request);

        $this->userRepository->update($user, $data);

        if ($user->admin_mode) {
            return to_route('panel.index')
                ->with('message.success', "Usuário {$data['login']} alterado com sucesso.");
        }

        return to_route('client-area.index')
            ->with('message.success', "Usuário {$data['login']} alterado com sucesso.");
    }

    /** 
     * Remove the specified resource from storage
     * 
     * @param int $id
     * @return \Illuminate\Http\Response  */
    public function destroy($id)
    {
        $user = User::find($id);
        $this->deleteAvatar($user);
        $this->userRepository->delete($user);

        return to_route('panel.index')->with('message.success', 'Cliente excluído com sucesso');
    }
}
