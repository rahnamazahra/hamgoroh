<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest
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
    public function rules()
    {
        switch ($this->method())
        {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                $rules = [
                    'title' => 'required|string|unique:fields,title',
                ];
                return $rules;
            case 'PUT':
            case 'PATCH':
                $field= $this->route()->parameter('field');
                return [
                    'title' => 'required|string|unique:fields,title,'.$field->id,
                ];
            default:break;
        }
    }
}
