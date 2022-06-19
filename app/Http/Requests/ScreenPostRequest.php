<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScreenPostRequest extends FormRequest
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
            'nome' => 'required|string|max:255',
            'filas' => 'required|integer|min:1',
            'posicoes' => 'required|integer|min:1',
        ];
    }
}
