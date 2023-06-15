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
        // return false;
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
            'login' => 'required|regex:/^[a-zA-Z0-9\s\-\_]+$/',
            'email' => [
                'required', 
                'regex:/^[\w\-\.]+\@[\w-]+\.[\w-]+\.[\w-]{2}|[\w\-]+\@[\w]+\.[\w-]+$/i',
            ],
            'password' => 'required|regex:/^[\w\+\=\-\*\.\!\@\#\$\%\&\*]+/',
            'confirm_password' => 'required|same:password'
        ];
    }

    function messages()
    {
        return [
            'login.required' => 'Este campo é obrigatório',
            'login.regex' => 'Este campo não deve ter caracteres especiais',
            'email.required' => 'Este campo é obrigatório',
            'email.regex' => 'Formato de e-mail inválido',
            'password.required' => 'Este campo é obrigatório',
            'password.regex' => 'Recomendamos senhas com letras e números',
            'confirm_password.same' => 'Este campo deve ser idêntico ao campo senha'
        ];
    }
}
