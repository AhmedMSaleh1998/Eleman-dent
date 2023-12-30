<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'       => 'required',
            'code'       => 'required',
            'value'      => 'required',
            'type'       => 'required',
            'uses'       => 'required|integer',
            'min_total'  => 'required|integer',
            'valid_from' => 'required',
            'valid_to'   => 'required',
            'status'     => 'boolean',
        ];
    }
}
