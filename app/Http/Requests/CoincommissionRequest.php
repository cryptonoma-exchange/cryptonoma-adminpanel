<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class CoincommissionRequest extends FormRequest
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
            'symbol' => 'required',
            // 'withdraw' => 'required|regex:/^[0-9. -]+$/',
            // 'buy' => 'required|regex:/^[0-9. -]+$/',
            // 'sell' => 'required|regex:/^[0-9. -]+$/',
            // 'type' => 'required',
            // 'contractaddress' => 'required_if:type,==,token',
            // 'abiarray' => 'required_if:type,==,token',
            // 'coinname' => 'required',
            // 'netfee' => 'required|regex:/^[0-9. -]+$/',
         //   'digit' => 'required|regex:/^[0-9. -]+$/',
            // 'min_deposit' => 'required|regex:/^[0-9. -]+$/',
            // 'min_withdraw' => 'required|regex:/^[0-9. -]+$/',
            'image' => 'nullable | mimes:png,Png,PNG,svg | max:1024',
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
            'symbol.required' => 'Symbol is required',
            'withdraw.required' => 'Withdraw is required',
            'buy.required' => 'Trade buy commission is required',
            'sell.required' => 'Trade sell commission is required',
            'type.required' => 'Type is required',
            'contractaddress.required' => 'Contract Address is required',
            'abiarray.required' => 'Abi Array is required',
            'coinname.required' => 'Coin Name is required',
            'netfee.required' => 'Netfee is required',
            'digit.required' => 'Digits is required',
            'min_deposit.required' => 'Minimum deposit is required',
            'min_withdraw.required' => 'Minimum withdraw is required',
            'image.dimensions' => 'Image must be dimission of 65 X 65',
        ];
    }
}
