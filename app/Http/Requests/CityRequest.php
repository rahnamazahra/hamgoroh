<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class CityRequest extends FormRequest
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
                    'title' => 'required|string|unique:cities,title',
                ];
                return $rules;
            case 'PUT':
            case 'PATCH':
                $city = $this->route()->parameter('city');
                return [
                    'title' => 'required|string|unique:cities,title,'.$city->id,
                ];
            default:break;
        }

    }
}
