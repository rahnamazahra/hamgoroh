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
            'title' => 'required|string|min:3',
            'is_active' => 'required|boolean',
            'registration_start_date' => 'required|date_format:Y/m/d',
            'registration_finish_date' => 'required|date_format:Y/m/d',
            'start_time1' => 'required',
            'start_time2' => 'required',
            'finish_time1' => 'required',
            'finish_time2' => 'required',
            'registration_description' => 'required|string',
            'rules_description' => 'required|string',
            'letter_method' => 'nullable|max:4096|file|mimes:pdf',
            'banner' => 'required|max:4096|file|mimes:jpeg,png,jpg,gif,svg,jfif',
            'creator' => 'required',
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
