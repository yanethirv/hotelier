<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestProduct extends FormRequest
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
    public function rules($product)
    {
        return [
            'name' => ['required', 'min:3', 'max:100', Rule::unique('products','name')->ignore($product)],
            'description' => ['required', 'min:3', 'max:255'],
            'stripe_id' => ['nullable'],
        ];
    }
}
