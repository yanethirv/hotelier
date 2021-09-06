<?php

namespace App\Http\Requests;

use App\Models\Occupancy;
use App\Models\Property;
use App\Models\RatePlan;
use App\Models\RoomType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestRoom extends FormRequest
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
    public function rules($room)
    {
        $properties = Property::pluck('id');
        $properties = $properties->join(',');

        $occupancies = Occupancy::pluck('id');
        $occupancies = $occupancies->join(',');

        $roomTypes = RoomType::pluck('id');
        $roomTypes = $roomTypes->join(',');

        $ratePlans = RatePlan::pluck('id');
        $ratePlans = $ratePlans->join(',');

        return [
            'code' => ['required', 'min:1', 'max:50'],
            'property_id' => "required|in:{$properties}",
            'room_type_id' => "required|in:{$roomTypes}",
            'occupancy_id' => "required|in:{$occupancies}",
            'floor' => ['min:1', 'max:20'],
            'number' => ['min:1', 'max:20'],
            'description' => ['min:1', 'max:255'],
            'rate_plan_id' => "required|in:{$ratePlans}",
            'rate' => ['min:1', 'max:50'],
            'amount_extra_person' => ['min:1', 'max:50'],
            'late_check_out' => ['min:1', 'max:50'],
            'early_check_in' => ['min:1', 'max:50'],
            'day_pass_fee' => ['min:1', 'max:50'],
            'night_pass_fee' => ['min:1', 'max:50'],
            'roll_away_bed' => ['min:1', 'max:50'],
            'pet_fee' => ['min:1', 'max:50'],
        ];
    }
}
