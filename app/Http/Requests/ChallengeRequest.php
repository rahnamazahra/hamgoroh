<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChallengeRequest extends FormRequest
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
        switch ($this->method())
        {
            case ('GET'):
                break;

            case ('POST'):
                $rules = [
                    'age_ranges'  => 'required',
                    'gender'      => 'required',
                    'nationality' => 'required',
                ];

                return $rules;

            case ('PUT'):
                break;

            case ('PATCH'):
                return [
                    'age_ranges'  => 'required',
                    'gender'      => 'required',
                    'nationality' => 'required',
                ];

            case ('DELETE'):
                break;

            default:
                break;
        }
    }
}
