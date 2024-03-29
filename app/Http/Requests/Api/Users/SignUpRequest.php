<?php

namespace App\Http\Requests\Api\Users;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'name' => ['required', 'min:1', 'max:15'],
            'email' => ['required', 'email:rfc', 'max:255', 'unique:users'],
            'password' => ['required', 'min:4', 'max:25', 'confirmed'],
            'checkbox' => ['accepted']
        ];
    }
}
