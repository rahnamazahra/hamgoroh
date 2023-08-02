<?php

namespace App\Http\Requests;

class StepRequest extends CustomRequest
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

//          'title'          => 'required|string|min:3',
//           level'          => 'required',
//          'weight'         => 'required',
//          'type'           => 'required',
//          'competition_id' => 'required',
        ];
    }
}
