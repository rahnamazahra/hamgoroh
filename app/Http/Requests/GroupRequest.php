<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
                    'groups' => 'required'
                ];

                return $rules;

            case 'PUT':

            case 'PATCH':
                $group = $this->route()->parameter('group');
                return [
                    'title' => 'required|string|min:3',
                    'fields' => 'required',
                    'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg,jfif|max:4096',
                ];

            case 'DELETE':

            default:break;
        }
    }
}
