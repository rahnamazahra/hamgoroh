<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'show_question' => 'required',
            'is_random' => 'nullable',
            'is_limit' => 'nullable',
            'is_negative' => 'nullable',
            'is_score' => 'nullable',
            'duration' => 'required',
            'easy_count' => 'required',
            'normal_count' => 'required',
            'hard_count' => 'required',
            'is_active' => 'required',
        ];
    }
}
