<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelfStepRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':


            case 'POST':

                $rules = [
                    'challenge_id' => 'required',
                    'title' => 'required|min:3',
                    'level' => 'required',
                    'type' => 'required',
                    'weight' => 'required',
                ];

                return $rules;

            case 'PUT':

            case 'PATCH':
                return [
                    'title' => 'required|min:3',
                    'level' => 'required',
                    'type' => 'required',
                    'weight' => 'required',
                ];

            case 'DELETE':

            default:
                break;
        }
    }
}
