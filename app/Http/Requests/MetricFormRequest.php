<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetricFormRequest extends FormRequest
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
            'date' => 'required|date',
            'metric_data' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'Este campo é obrigatório',
            'date.date' => 'Formato de data incorreto',
            'metric_data.required' => 'Este campo é obrigatório',
            'metric_data.numeric' => 'Somente números são permitidos neste campo'
        ];
    }
}
