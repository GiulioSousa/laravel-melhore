<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosticFormRequest extends FormRequest
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
            'diagnostic_text'=> [
                'required', 
                'regex:/^[À-ú\w\s.,:;?!]*$/'
            ]
        ];
    }
    
    public function messages()
    {
        return [
            'diagnostic_text.require' => 'Este campo é obrigatório',
            'diagnostic_text.regex' => 'Este campo não permite o uso de caracteres especiais'
        ];
    }


}
