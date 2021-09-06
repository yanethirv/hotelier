<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestPhotoLocation extends FormRequest
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
    public function rules($photoLocation)
    {
        return [
            'name' => ['required', 'min:3', 'max:50', Rule::unique('photo_locations','name')->ignore($photoLocation)],
        ];
    }
}
