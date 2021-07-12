<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetRequest extends FormRequest
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
            'date_name' => 'required',
            'cash_jpy_name' => 'required',
            'cash_dol_name' => 'required',
            'inv_jpy_name' => 'required',
            'inv_dol_name' => 'required',
            'stock_us_name' => 'required',
            'stock_other_name' => 'required',
            'rate_name' => 'required',
            //
        ];
    }

    public function messages()
    {
        return [
            'date_name.required' => 'Please fill out this item.',
            'cash_jpy_name.required' => 'Please enter this item.',
        ];
    }

}
