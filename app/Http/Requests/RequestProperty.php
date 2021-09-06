<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Country;
use App\Models\RoomRange;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestProperty extends FormRequest
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
    public function rules($property)
    {
        $roomRanges = RoomRange::pluck('id');
        $roomRanges = $roomRanges->join(',');

        $categories = Category::pluck('id');
        $categories = $categories->join(',');

        $countries = Country::pluck('id');
        $countries = $countries->join(',');

        return [
            'name' => ['required', 'min:3', 'max:100', Rule::unique('properties','name')->ignore($property)],
            'room_range_id' => "required|in:{$roomRanges}",
            'category_id' => "required|in:{$categories}",
            'description' => ['min:3', 'max:100'],
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => ['min:3', 'max:100'],
            'country_id' => "required|in:{$countries}",
            'stars' => ['min:1', 'max:20'],
            'opening_date' => ['min:1', 'max:20'],
            'floor_number' => ['min:1', 'max:20'],
            'instagram' => ['min:1', 'max:20'],
            'facebook' => ['min:1', 'max:20'],
            'linkedin' => ['min:1', 'max:20'],
            'youtube' => ['min:1', 'max:20'],
            'twitter' => ['min:1', 'max:20'],
            'frontdesk_phone' => ['min:1', 'max:20'],
            'frontdesk_email' => ['min:1', 'max:20'],
            'reservation_phone' => ['min:1', 'max:20'],
            'reservation_email' => ['min:1', 'max:20'],
            'billing_email' => ['min:1', 'max:20'],
            'state' => ['min:1', 'max:20'],
            'city' => ['min:1', 'max:20'],
            //'experience' => ['min:1', 'max:255'],
        ];
    }
}
