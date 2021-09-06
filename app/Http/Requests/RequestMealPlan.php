<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestMealPlan extends FormRequest
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
    public function rules($mealPlan)
    {
        $properties = Property::pluck('id');
        $properties = $properties->join(',');

        return [
            'name' => ['required', 'min:3', 'max:50', Rule::unique('meal_plans','name')->ignore($mealPlan)],
            'rate' => ['required', 'min:', 'max:10'],
            'property_id' => "required|in:{$properties}",
        ];
    }
}
