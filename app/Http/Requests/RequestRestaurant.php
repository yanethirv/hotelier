<?php

namespace App\Http\Requests;

use App\Models\Property;
use App\Models\RestaurantLocation;
use App\Models\RestaurantTheme;
use App\Models\RestaurantType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestRestaurant extends FormRequest
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
    public function rules($restaurant)
    {
        $properties = Property::pluck('id');
        $properties = $properties->join(',');

        $restaurantThemes = RestaurantTheme::pluck('id');
        $restaurantThemes = $restaurantThemes->join(',');

        $restaurantTypes = RestaurantType::pluck('id');
        $restaurantTypes = $restaurantTypes->join(',');

        $restaurantLocations = RestaurantLocation::pluck('id');
        $restaurantLocations = $restaurantLocations->join(',');

        return [
            'name' => ['required', 'min:1', 'max:50', Rule::unique('restaurants','name')->ignore($restaurant)],
            'property_id' => "required|in:{$properties}",
            'restaurant_theme_id' => "required|in:{$restaurantThemes}",
            'restaurant_type_id' => "required|in:{$restaurantTypes}",
            'restaurant_location_id' => "required|in:{$restaurantLocations}",
            'how_many_pax' => ['min:1', 'max:50'],
            'open_time' => ['min:1', 'max:50'],
            'closing_time' => ['min:1', 'max:50'],
            'included' => ['min:1', 'max:50'],
        ];
    }
}
