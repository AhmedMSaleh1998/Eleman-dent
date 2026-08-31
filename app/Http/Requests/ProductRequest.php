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
            'name_ar'           => 'required|string|max:255',
            'name_en'           => 'required|string|max:255',
            'image'             => 'nullable|image',
            'title_ar'  => 'required|string|max:20000',
            'title_en'  => 'required|string|max:20000',
            'keywords_ar'  => 'required|string|max:20000',
            'keywords_en'  => 'required|string|max:20000',
            'keywords_meta_ar'  => 'required|string|max:20000',
            'keywords_meta_en'  => 'required|string|max:20000',
            'description_ar'  => 'required|string|max:20000',
            'description_en'  => 'required|string|max:20000',
            'description_meta_ar'  => 'required|string|max:20000',
            'description_meta_en'  => 'required|string|max:20000',
            'alt_en'          => 'required|string|min:2|max:191',
            'alt_ar'          => 'required|string|min:2|max:191',
            'warranty_ar'     => 'nullable|string|max:191',
            'warranty_en'     => 'nullable|string|max:191',
            'category_id'       => 'required|array',
            'brand_id'          => 'nullable|integer',
            'quantity'          => 'required|integer',
            'price'             => 'required',
            'seq' => 'required',
            'discount_price' => 'nullable',
            'pdf' => 'sometimes|file|mimes:pdf',
            'video_url'         => 'nullable|url',
            'is_top_product'    => 'nullable|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'name_ar'              => 'اسم المنتج (عربي)',
            'name_en'              => 'اسم المنتج (إنجليزي)',
            'title_ar'             => 'عنوان الصفحة SEO (عربي)',
            'title_en'             => 'عنوان الصفحة SEO (إنجليزي)',
            'description_ar'       => 'الوصف (عربي)',
            'description_en'       => 'الوصف (إنجليزي)',
            'description_meta_ar'  => 'وصف الميتا SEO (عربي)',
            'description_meta_en'  => 'وصف الميتا SEO (إنجليزي)',
            'keywords_ar'          => 'الكلمات المفتاحية (عربي)',
            'keywords_en'          => 'الكلمات المفتاحية (إنجليزي)',
            'keywords_meta_ar'     => 'كلمات الميتا (عربي)',
            'keywords_meta_en'     => 'كلمات الميتا (إنجليزي)',
            'alt_ar'               => 'النص البديل للصورة (عربي)',
            'alt_en'               => 'النص البديل للصورة (إنجليزي)',
            'warranty_ar'          => 'الضمان (عربي)',
            'warranty_en'          => 'الضمان (إنجليزي)',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'حقل :attribute إجباري.',
            'max'      => 'حقل :attribute يتجاوز الحد الأقصى المسموح (:max حرفًا).',
            'string'   => 'حقل :attribute يجب أن يكون نصًا.',
        ];
    }
}
