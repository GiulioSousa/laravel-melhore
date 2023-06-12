<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class AccountController extends Controller
{

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateData($request);
        $avatarPath = $this->newAvatar($request);
        
        $data = $request->except('_token', 'confirm_password');
        $data['password'] = Hash::make($data['password']);
        $data['admin_mode'] = 0;
        $data['avatar'] = $avatarPath;

        $this->userRepository->create($data);

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
    /** 
     * Remove the specified resource from storage
     * 
     * @param int $id
     * @return \Illuminate\Http\Response  */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return to_route('panel.index')->with('message.success', 'Cliente excluído com sucesso');
        //implementar exclusão do arquivo de avatar do armazenamento
        //Verificar a situação dos videos relacionados ao user_id
        //UTILIZAR O SISTEMA DE REPOSITÓRIOS
    }
    
    public function newAvatar(Request $request): string
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $this->extensionValidate($request);
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

    public function extensionValidate(Request $request)
    {
        $file = $request->file('avatar');
        $rules = [
            'avatar' => 'mimetypes:
                image/bmp, 
                image/jpeg, 
                image/png'
        ];
        $messages = ['avatar.mimetypes' => 'Formato de imagem inválido'];

        Validator::validate(Arr::wrap($file), $rules, $messages);
            
        return $file->getClientOriginalExtension();
    }

    public function verifyData(Request $request): ValidationValidator
    {
        return Validator::make($request->except('_token'), [
            'login' => 'required|regex:/^[a-zA-Z0-9\s\-\_]+$/',
            'email' => [
                'required', 
                'regex:/^[\w\-\.]+\@[\w-]+\.[\w-]+\.[\w-]{2}|[\w\-]+\@[\w]+\.[\w-]+$/i',
                'max:16'
            ],
            'password' => 'required|regex:/^[\w\+\=\-\*\.\!\@\#\$\%\&\*]+/'
        ],
        [
            'login.required' => 'Este campo é obrigatório',
            'login.regex' => 'Este campo não deve ter caracteres especiais',
            'email.required' => 'Este campo é obrigatório',
            'email.regex' => 'Formato de e-mail inválido',
            'email.max' => 'Senha deve conter até 16 caracteres',
            'password.required' => 'Este campo é obrigatório',
            'password.regex' => 'Recomendamos senhas com letras e números'
        ]);
    }

    public function validateData(Request $request)
    {
        $validator = $this->verifyData($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput(); 
        }
    }
}
