<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'district_id' => 'required|exists:districts,id',
            'street' => 'required',
            'building' => 'required',
            'floor' => 'required',
            'apartment' => 'required',
            'phone' => 'nullable',
            'long' => 'nullable',
            'lat' => 'nullable',
            'user_id' => 'required',
        ];
    }
}
