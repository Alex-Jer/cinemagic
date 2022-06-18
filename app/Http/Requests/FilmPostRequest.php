<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilmPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titulo' => 'required|string|max:255',
            'genero_code' => 'required|string|max:255|exists:generos,code',
            'ano' => 'required|integer|min:1',
            'cartaz_url' => 'nullable|image|max:24576',
            'sumario' => 'required|string|max:255',
            'trailer_url' => 'nullable|string|max:255',
        ];
    }
}
