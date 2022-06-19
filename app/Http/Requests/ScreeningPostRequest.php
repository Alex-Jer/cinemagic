<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScreeningPostRequest extends FormRequest
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
            'filme_id' => 'required|integer|min:1',
            'sala_id' => 'required|integer|min:1',
            'data' => 'required|date',
            'horario_inicio' => 'required|date_format:H:i',
        ];
    }
}
