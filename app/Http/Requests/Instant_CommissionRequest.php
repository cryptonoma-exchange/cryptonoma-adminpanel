<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Instant_CommissionRequest extends FormRequest
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
            'name' => 'required',
            'source' => 'required',
            'buyamount' => 'required|regex:/^[0-9. -]+$/',
            'sellamount' => 'required|regex:/^[0-9. -]+$/'
            //'buy_commission' => 'required|regex:/^[0-9. -]+$/',
            //'sell_commission' => 'required|regex:/^[0-9. -]+$/',
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
            'name.required' => 'Payment name is required',
            'source.required' => 'Payment Source is required',
            'buyamount.required' => 'Buy amount is required',
            'sellamount.required' => 'Sell amount is required'
            //'buy_commission.required' => 'Buy commission is required',
            //'sell_commission.required' => 'Sell commission is required',
        ];
    }
}
