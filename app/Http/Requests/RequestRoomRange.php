<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestRoomRange extends FormRequest
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
    public function rules($roomRange)
    {
        return [
            'name' => ['required', 'min:3', 'max:50', Rule::unique('room_ranges','name')->ignore($roomRange)],
            'description' => ['required', 'min:3'],
        ];
    }
}
