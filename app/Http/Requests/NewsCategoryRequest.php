<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsCategoryRequest extends FormRequest
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
     * @return array<string, mixed>
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
                    'title' => 'required|string|unique:news_categories,title',
                ];
                return $rules;
            case 'PUT':
            case 'PATCH':
                $newsCategory= $this->route()->parameter('newsCategory');
                return [
                    'title' => 'required|string|unique:news_categories,title,'.$newsCategory->id,
//                    'title' => 'required|string',
                ];
            default:break;
        }
    }
}
