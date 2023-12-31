<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        return [
            'title' => 'required|string|min:3',
            'sub_title' => 'nullable|string',
            'preview' => 'nullable|string',
            'body' => 'required|string',
            'is_published' => 'required',
            'news_category' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,jfif|max:4096'
        ];
    }
}
