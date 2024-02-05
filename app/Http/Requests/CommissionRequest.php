<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommissionRequest extends FormRequest
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
            'withdraw' => 'required|regex:/^[0-9. -]+$/',
            'buy' => 'required|regex:/^[0-9. -]+$/',
            'sell' => 'required|regex:/^[0-9. -]+$/',
            'min_trade_price' => 'required|regex:/^[0-9. -]+$/',
        ];
    }
     /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function message()
    {
        return [
            'withdraw.required' => 'Withdraw commission is required',
            'buy.required' => 'Trade buy commission is required',
            'sell.required' => 'Trade sell commission is required',
            'min_trade_price.required' => 'Trade minmum price is required',
        ];
    }
}
