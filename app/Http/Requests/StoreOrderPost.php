<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'source_currency_code' => 'required|string|max:3',
            'currency_code' => 'required|string|max:3',
            'exchange_rate' => 'required|numeric',
            'surcharge_percent' => 'required|numeric',
            'surcharge_amount' => 'required|numeric',
            'discount_percent' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'source_currency_amount' => 'required|numeric',
            'currency_amount' => 'required|numeric',
            'source_total' => 'required|numeric',
        ];
    }
}
