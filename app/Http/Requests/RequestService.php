<?php

namespace App\Http\Requests;

use App\Models\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestService extends FormRequest
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
    public function rules($service)
    {
        $types = Type::pluck('id');

        $types = $types->join(',');

        return [
            'name' => ['required', 'min:3', 'max:100', Rule::unique('services','name')->ignore($service)],
            'description' => ['required', 'min:3', 'max:255'],
            'price' => 'required|regex:/^\d*(\.\d{2})?$/',
            'cost' => 'required|regex:/^\d*(\.\d{2})?$/',
            'type_id' => "required|in:{$types}",
            'attachment' => 'nullable',
        ];
    }
}
