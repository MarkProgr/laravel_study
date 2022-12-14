<?php

namespace App\Http\Requests\Movies;

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
            'title' => ['required', 'min:1', 'max:255'],
            'year_of_issue' => ['required', 'numeric'],
            'description' => ['required', 'min:100'],
            'jenres' => ['required', 'array', 'min:1'],
            'jenres.*' => ['required', 'exists:jenres,id'],
            'actors' => ['required', 'array', 'min:1'],
            'actors.*' => ['required', 'exists:actors,id'],
        ];
    }
}
