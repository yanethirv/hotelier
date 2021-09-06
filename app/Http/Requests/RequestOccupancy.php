<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestOccupancy extends FormRequest
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
    public function rules($occupancy)
    {
        return [
            'name' => ['required', 'min:3', 'max:50', Rule::unique('occupancies','name')->ignore($occupancy)],
            'description' => ['required', 'min:3'],
        ];
    }
}
