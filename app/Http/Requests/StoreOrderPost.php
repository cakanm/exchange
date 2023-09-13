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
            'exchange_rate' => 'required|numeric:0,6',
            'surcharge_percent' => 'required|numeric:0,2',
            'surcharge_amount' => 'required|numeric:0,2',
            'discount_percent' => 'required|numeric:0,2',
            'discount_amount' => 'required|numeric:0,2',
            'source_currency_amount' => 'required|numeric:0,2',
            'currency_amount' => 'required|numeric:0,2',
            'source_total' => 'required|numeric:0,2',
        ];
    }
}
