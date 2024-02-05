<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class TradepairRequest extends FormRequest
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
            'coinone' => 'required',
            'cointwo' => 'required',
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
            'coinone.required' => 'Coinone is required',
            'cointwo.required' => 'Cointwo is required',
        ];
    }
}
