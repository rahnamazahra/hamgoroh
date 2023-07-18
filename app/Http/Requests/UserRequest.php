<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        switch ($this->method())
        {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                $rules = [
                    'first_name'    => 'required|string|min:3',
                    'last_name'     => 'required|string|min:3',
                    'phone'         => 'required|unique:users,phone',
                    'national_code' => 'nullable|integer|unique:users,national_code',
                ];
                return $rules;
            case 'PUT':
            case 'PATCH':
                $user= $this->route()->parameter('user');
                return [
                    'first_name'    => 'required|string|min:3',
                    'last_name'     => 'required|string|min:3',
                    'phone'         => 'required|unique:users,phone,'.$user->id,
                    'national_code' => 'nullable|unique:users,national_code,'.$user->id,
                ];
            default:break;
        }

    }
}
