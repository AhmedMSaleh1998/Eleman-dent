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
            'title_ar'  => 'required',
            'title_en'  => 'required',
            'keywords_ar'  => 'required',
            'keywords_en'  => 'required',
            'keywords_meta_ar'  => 'required',
            'keywords_meta_en'  => 'required',
            'description_ar'  => 'required|max:2500',
            'description_en'  => 'required|max:2500',
            'description_meta_ar'  => 'required|max:2500',
            'description_meta_en'  => 'required|max:2500',
            'alt_en'          => 'required|string|min:2|max:191',
            'alt_ar'          => 'required|string|min:2|max:191',
            'category_id'       => 'required|array',
            'brand_id'          => 'nullable|integer',
            'quantity'          => 'required|integer',
            'price'             => 'required',

        ];
    }
}
