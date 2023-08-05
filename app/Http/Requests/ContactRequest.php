<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'address' => 'required|string',
            'postal_code' => 'nullable',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'body' => 'nullable|string',
            'telegram' => 'nullable|string',
            'whatsapp' => 'nullable|string',
            'instagram' => 'nullable|string',
        ];
    }
}
