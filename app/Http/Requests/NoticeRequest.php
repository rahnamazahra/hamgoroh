<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'is_sent_users' => 'nullable',
            'is_sent_referees' => 'nullable',
            'is_sent_generals' => 'nullable',
            'is_sent_provincials' => 'nullable',
            'selected_users' => 'nullable',
        ];
    }
}
