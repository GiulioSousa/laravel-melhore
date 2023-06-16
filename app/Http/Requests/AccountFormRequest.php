<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'avatar' => 'image',
            'login' => 'required|regex:/^[A-Za-z0-9-_]+$/',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|regex:/^[\w\+\-\.]+$/',
            'confirm_password' => 'required|same:password'
        ];
    }

    function messages()
    {
        return [
            'avatar.image' => 'Formato de arquivo inválido',
            'login.required' => 'Este campo é obrigatório',
            'login.regex' => 'Este campo não deve ter caracteres especiais',
            'email.required' => 'Este campo é obrigatório',
            'email.email' => 'Endereço de e-mail inválido',
            'password.required' => 'Este campo é obrigatório',
            'password.regex' => 'Recomendamos senhas com letras e números',
            'confirm_password.required' => 'Este campo é obrigatório',
            'confirm_password.same' => 'Este campo deve ser idêntico ao campo senha'
        ];
    }
}
