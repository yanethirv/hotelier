<?php

namespace App\Http\Requests;

use App\Models\RequestStatus;
use Illuminate\Foundation\Http\FormRequest;

class RequestActivationServiceTransaction extends FormRequest
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
    public function rules($activationServiceTransaction)
    {
        $requestStatuses = RequestStatus::pluck('id');

        $requestStatuses = $requestStatuses->join(',');

        return [
            'request_status_id' => "required|in:{$requestStatuses}"
        ];
    }
}
