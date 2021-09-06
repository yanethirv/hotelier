<?php

namespace App\Http\Requests;

use App\Models\Occupancy;
use App\Models\PhotoLocation;
use App\Models\Property;
use App\Models\RoomType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestPhoto extends FormRequest
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
    public function rules($photo)
    {
        $properties = Property::pluck('id');
        $properties = $properties->join(',');

        $photoLocations = PhotoLocation::pluck('id');
        $photoLocations = $photoLocations->join(',');

        return [
            'title' => ['required', 'min:1', 'max:50'],
            'property_id' => "required|in:{$properties}",
            'photo_location_id' => "required|in:{$photoLocations}",
            'photo_path' => 'nullable|image|max:2048',
        ];
    }
}
