<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            case 'GET':


            case 'POST':

                $rules = [
                    'title'       => 'required|string',
                    'slug'        => 'required|string|unique:roles,slug',
                ];

                return $rules;

            case 'PUT':

            case 'PATCH':
                $role = $this->route()->parameter('role');

                return [
                    'title'       => 'required|string',
                    'slug'        => 'required|string|unique:roles,slug,'.$role->id,
                ];

            case 'DELETE':

            default:break;
        }
    }
}
