<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
class ProvinceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
     public function rules(): array
    {
        switch ($this->method())
        {
            case 'GET':

            case 'POST':
                $rules = [
                    'title' => 'required|string|unique:cities,title',
                ];

                return $rules;

            case 'PUT':

            case 'PATCH':
                $province = $this->route()->parameter('province');
                return [
                    'title' => 'required|string|unique:provinces,title,'.$province->id,
                ];

            case 'DELETE':

           default:break;
        }

    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator->errors())->withInput()
        );
    }
}
