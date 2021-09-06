<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestRatePlan extends FormRequest
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
    public function rules($ratePlan)
    {
        $properties = Property::pluck('id');
        $properties = $properties->join(',');

        return [
            'name' => ['required', 'min:3', 'max:50', Rule::unique('rate_plans','name')->ignore($ratePlan)],
            'suggestion' => ['required', 'min:3', 'max:150'],
            'description' => ['required', 'min:3', 'max:150'],
            'property_id' => "required|in:{$properties}",
        ];
    }
}
