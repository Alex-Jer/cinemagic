<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserPostRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'nif' => ['nullable', 'min:9', 'max:9'],
            'tipo_pagamento' => ['nullable', Rule::in(['PayPal', 'MBWay', 'Visa'])],
            'ref_pagamento' => 'nullable',
            'profile_pic' => ['nullable', 'image', 'max:8192'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
