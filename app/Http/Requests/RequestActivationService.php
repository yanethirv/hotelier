<?php

namespace App\Http\Requests;

use App\Models\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestActivationService extends FormRequest
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
    public function rules($activationService)
    {
        $types = Type::pluck('id');

        $types = $types->join(',');

        return [
            'name' => ['required', 'min:3', 'max:100', Rule::unique('activation_services','name')->ignore($activationService)],
            'description' => ['required', 'min:3'],
            'type_id' => "required|in:{$types}",
            'attachment' => 'nullable',
        ];
    }
}
