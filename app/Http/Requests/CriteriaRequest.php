<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CriteriaRequest extends FormRequest
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
            case 'DELETE':
                return [];
            case 'POST':
                $rules = [
                    'title' => 'required|string|unique:criterias,title',
                    'is_active' => 'required'
                ];
                return $rules;
            case 'PUT':
            case 'PATCH':
                $criteria= $this->route()->parameter('criteria');
                return [
                    'title' => 'required|string|unique:criterias,title,'.$criteria->id,
                    'is_active' => 'required'
                ];
            default:break;
        }
    }
}
