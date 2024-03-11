<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name_ar'  => 'required',
            'name_en'  => 'required',
            'title_ar'  => 'required',
            'title_en'  => 'required',
            'keywords_ar'  => 'required',
            'keywords_en'  => 'required',
            'keywords_meta_ar'  => 'required',
            'keywords_meta_en'  => 'required',
            'description_ar'  => 'required',
            'description_en'  => 'required',
            'description_meta_ar'  => 'required',
            'description_meta_en'  => 'required',
            'image' => 'nullable|image',
            'alt_en'          => 'required|string|min:2|max:191',
            'alt_ar'          => 'required|string|min:2|max:191',
        ];
    }
}
