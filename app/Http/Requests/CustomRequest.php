<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
class CustomRequest extends FormRequest
{
    protected function failedValidation($validator)
    {
        handleFailedValidation($validator->errors());
    }
}
