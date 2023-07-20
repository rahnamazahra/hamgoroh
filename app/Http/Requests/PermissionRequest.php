<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(Request $request): array
    {
        switch ($this->method())
        {
            case 'GET':


            case 'POST':

                $rules = [
                    'title'       => 'required|string',
                    'slug'        => 'required|string|unique:permissions,slug',
                    'description' => 'nullable',
                    'roles'       => 'required',
                ];

                return $rules;

            case 'PUT':

            case 'PATCH':
                $permission = $this->route()->parameter('permission');

                return [
                    'title'       => 'required|string',
                    'slug'        => 'required|string|unique:permissions,slug,'.$permission->id,
                    'description' => 'nullable',
                    'roles'       => 'required',
                ];

            case 'DELETE':

            default:break;
        }
    }
}
