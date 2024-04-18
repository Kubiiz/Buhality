<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'     => 'required|min:3|max:20',
            'player'    => 'required|min:2|max:10',
            'player.*'  => 'required|min:3|max:12|distinct',
            'count'     => 'required|numeric|between:5,15',
            'bomb'      => 'in:1',
        ];
    }
}
