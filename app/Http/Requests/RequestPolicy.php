<?php

namespace App\Http\Requests;

use App\Models\PolicyType;
use App\Models\Property;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestPolicy extends FormRequest
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

        $policyTypes = PolicyType::pluck('id');
        $policyTypes = $policyTypes->join(',');

        return [
            'name' => ['required', 'min:1', 'max:255'],
            'property_id' => "required|in:{$properties}",
            'policy_type_id' => "required|in:{$policyTypes}",
        ];
    }
}
