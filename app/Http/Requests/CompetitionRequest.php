<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Validator;

class CompetitionRequest extends FormRequest
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
            'title' => 'nullable|string|min:3',
            'is_active' => 'nullable|boolean',
            'registration_start_date' => 'nullable|date_format:Y/m/d',
            'registration_finish_date' => 'nullable|date_format:Y/m/d',
            'registration_description' => 'nullable|string',
            'rules_description' => 'nullable|string',
            'letter_method' => 'nullable|string',
            'banner' => 'nullable|string',
            'creator' => 'nullable',
        ];
    }

    public function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => $validator->errors()
            ],
            422)
        );
    }
}
