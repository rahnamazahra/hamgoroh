<?php

namespace App\Http\Requests;

use App\Http\Requests\CustomRequest;

class UserRequest extends CustomRequest
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
    public function  rules(): array
    {
        switch ($this->method())
        {
            case 'GET':

            case 'POST':

                $rules = [
                    'first_name'    => 'required|string|min:3',
                    'last_name'     => 'required|string|min:3',
                    'phone'         => 'required|size:11|unique:users,phone',
                    'national_code' => 'required|size:10|unique:users,national_code',
                    'gender'        => 'required',
                    'city_id'       => 'required',
                    'birthday_date' => 'required|date_format:Y/m/d',
                    'avatar'        => 'nullable|max:4096|file|mimes:jpeg,png,jpg,gif,svg,jfif',
                    'roles'         => 'required',
                ];

                return $rules;

            case 'PUT':

            case 'PATCH':
                $user= $this->route()->parameter('user');
                return [
                    'first_name'    => 'required|string|min:3',
                    'last_name'     => 'required|string|min:3',
                    'phone'         => 'required|size:11|unique:users,phone,'.$user->id,
                    'national_code' => 'required|size:10|unique:users,national_code,'.$user->id,
                    'gender'        => 'required',
                    'city_id'       => 'required',
                    'birthday_date' => 'required|date_format:Y/m/d',
                    'avatar'        => 'nullable|max:4096|file|mimes:jpeg,png,jpg,gif,svg,jfif',
                    'roles'         => 'required',
                ];

           case 'DELETE':

           default:break;
        }
    }

}
