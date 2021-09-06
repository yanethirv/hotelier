<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestCategory extends FormRequest
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
    public function rules($category)
    {
        return [
            'name' => ['required', 'min:3', 'max:50', Rule::unique('categories','name')->ignore($category)],
            'description' => ['required', 'min:3'],
        ];
    }
}
