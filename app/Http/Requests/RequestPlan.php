<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestPlan extends FormRequest
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
    public function rules($plan)
    {
        $products = Product::pluck('id');
        $products = $products->join(',');

        return [
            'nickname' => ['required', 'min:3', 'max:100', Rule::unique('plans','nickname')->ignore($plan)],
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
            'description' => ['required', 'min:3', 'max:255'],
            'product_id' => "required|in:{$products}",
            'product' => ['nullable'],
            'product_name' => ['nullable'],
            'stripe_id' => ['nullable'],
        ];
    }
}
