<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestRestaurantType extends FormRequest
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
    public function rules($restaurantType)
    {
        return [
            'name' => ['required', 'min:3', 'max:50', Rule::unique('restaurant_types','name')->ignore($restaurantType)],
            'description' => ['required', 'min:3'],
        ];
    }
}
