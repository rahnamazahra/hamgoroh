<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SelfChallengeRequest extends FormRequest
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
                    'field_id' => 'required',
                    'age_id' => 'required',
                    'gender' => 'required',
                    'nationality' => 'required'
                ];

                return $rules;

            case 'PUT':

            case 'PATCH':
                return [
                    'age_id' => 'required',
                    'gender' => 'required',
                    'nationality' => 'required'
                ];

            case 'DELETE':

            default:
                break;
        }
    }
}
