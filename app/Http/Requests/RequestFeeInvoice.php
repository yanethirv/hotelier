<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestFeeInvoice extends FormRequest
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
    public function rules($invoice)
    {
        $users = User::pluck('id');
        $users = $users->join(',');

        return [
            'amount' => 'required|regex:/^\d{1,3}(?:\.\d\d\d)*(?:,\d{1,2})?$/',
            'description' => ['required', 'min:3', 'max:255'],
            'user_id' => "required|in:{$users}",
            'details' => ['max:255'],
        ];
    }
}
