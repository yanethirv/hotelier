<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestExperience extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules($experience)
    {
        return [
            'name' => ['required', 'min:6', 'max:50', Rule::unique('experiences','name')->ignore($experience)],
            'description' => ['required', 'min:3'],
        ];
    }
}
