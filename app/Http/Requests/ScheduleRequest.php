<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
                    'groups' => 'required',
                ];
                return $rules;
            case 'PUT':
            case 'PATCH':
                return [
                    'start_time1' => 'required',
                    'start_time2' => 'required',
                    'finish_time1' => 'required',
                    'finish_time2' => 'required',
                    'date' => 'required',
                    'user_id' => 'nullable',
                ];
            default:break;
        }
    }
}
