<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Affilate_CommissionRequest extends FormRequest
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
            'coin_name' => 'required',
            'deposit' => 'required|regex:/^[0-9. -]+$/',
            'trade' => 'required|regex:/^[0-9. -]+$/',
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
            'coin_name.required' => 'Coin name commission is required',
            'deposit.required' => 'Deposit commission is required',
            'trade.required' => 'Trade commission is required',
        ];
    }
}
