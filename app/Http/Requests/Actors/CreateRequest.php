<?php

namespace App\Http\Requests\Actors;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'max:15'],
            'surname' => ['required', 'min:4', 'max:20'],
            'date_of_birth' => ['required', 'date'],
            'height' => ['required', 'numeric'],
        ];
    }
}
