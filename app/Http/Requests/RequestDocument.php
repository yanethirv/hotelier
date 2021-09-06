<?php

namespace App\Http\Requests;

use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;

class RequestDocument extends FormRequest
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
    public function rules()
    {
        $properties = Property::pluck('id');
        $properties = $properties->join(',');
        

        return [
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:255', 
            'attachment' => 'nullable|sometimes|file|mimes:jpeg,png,doc,docs,pdf|max:10000',
            'property_id' => "required|in:{$properties}",
        ];
    }
}
