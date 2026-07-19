<?php

namespace App\Http\Requests;

use App\Models\Category;
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
        $categoryId = $this->route('category');

        return [
            'parent_id' => [
                'nullable',
                'integer',
                'exists:categories,id',
                function ($attribute, $value, $fail) use ($categoryId) {
                    if (!$categoryId || !$value) {
                        return;
                    }
                    if ((int) $value === (int) $categoryId) {
                        $fail('لا يمكن أن يكون القسم أباً لنفسه.');
                        return;
                    }
                    $category = Category::find($categoryId);
                    if ($category && in_array((int) $value, $category->descendantIds())) {
                        $fail('لا يمكن نقل القسم داخل أحد أقسامه الفرعية.');
                    }
                },
            ],
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
            'banner' => 'nullable|image',
            'show_in_home' => 'nullable|boolean',
            'home_order' => 'nullable|integer|min:0',
            'alt_en'          => 'required|string|min:2|max:191',
            'alt_ar'          => 'required|string|min:2|max:191',
        ];
    }
}
