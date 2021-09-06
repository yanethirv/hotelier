<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestPolicyType extends FormRequest
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
    public function rules($policyType)
    {
        return [
            'name' => ['required', 'min:3', 'max:50', Rule::unique('policy_types','name')->ignore($policyType)],
            'description' => ['required', 'min:3'],
        ];
    }
}
