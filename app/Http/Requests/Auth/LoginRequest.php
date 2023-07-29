<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\CustomRequest;

class LoginRequest extends CustomRequest
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
     * @return array<string, array|\Illuminate\Contracts\Validation\ValidationRule|string>
     */
    public function rules(): array
    {
        return [
            'phone' => 'required|exists:users,phone|size:11',
        ];
    }
}
