<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoFormRequest extends FormRequest
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
            'title' => [
                'required',
                'regex:/^[À-ú\w\s.,:;?!|]+$/'
            ],
            'description' => [
                'required',
                'regex:/^[À-ú\w\s\d\/\-\_\.\:\=\?\|]+$/'   
            ],
            'url' => ['required', 'url', 'regex:/^(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/watch\?v=|youtu\.be\/)(?:[\w-]{11})/']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Este campo é obrigatório',
            'title.regex' => 'Este campo só pode conter letras e números',
            'description.required' => 'Este campo é obrigatório',
            'description.regex' => 'Este campo não pode conter caracteres especiais',
            'url.required' => 'Este campo é obrigatório',
            'url.url' => 'Este campo deve conter uma URL válida.',
            'url.regex' => 'A URL deve ser de um vídeo do YouTube.',
        ];
    }
}
