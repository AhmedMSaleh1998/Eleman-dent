<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name_ar'           => 'required',
            'name_en'           => 'required',
            'image'             => 'nullable|image',
            'description_ar'    => 'required',
            'description_en'    => 'required',
            'category_id'       => 'required|integer',
            'color_id'          => 'array',
            'color_id.*'        => 'integer|exists:colors,id',
            'type_id'           => 'array',
            'type_id.*'         => 'integer|exists:types,id',
            'sku'               => 'required',
            'related_id'        => 'array',
            'related_id.*'      => 'integer|nullable|exists:products,id'
        ];
    }
}
