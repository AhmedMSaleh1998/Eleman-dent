<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        // في الإضافة لازم صورة أو فيديو (واحد بس) — في التعديل الاتنين اختياريين
        // عشان يفضل الملف الحالي زي ما هو لو المستخدم مرفعش حاجة جديدة
        $creating = $this->isMethod('post');

        return [
            'name_ar'           => 'required',
            'name_en'           => 'required',
            'media_type'        => 'required|in:image,video',
            'image'             => ($creating ? 'required_without:video|' : '') . 'nullable|image',
            'video'             => ($creating ? 'required_without:image|' : '') . 'nullable|file|mimetypes:video/mp4,video/quicktime,video/webm|max:102400',
            'description_ar'  => 'required',
            'description_en'  => 'required',
            'location_ar'          => 'required|string',
            'location_en'          => 'required|string',
            'date'             => 'required|date',

        ];
    }

    public function messages()
    {
        return [
            'media_type.required'    => 'اختر نوع الملف: صورة أو فيديو.',
            'media_type.in'          => 'نوع الملف لازم يكون صورة أو فيديو.',
            'image.required_without' => 'ارفع صورة أو فيديو للحدث.',
            'video.required_without' => 'ارفع صورة أو فيديو للحدث.',
            'image.image'            => 'ملف الصورة غير صالح — ارفع JPG أو PNG أو WebP.',
            'video.mimetypes'        => 'صيغة الفيديو غير مدعومة — ارفع MP4 أو MOV أو WebM.',
            'video.max'              => 'حجم الفيديو أكبر من الحد المسموح (100 ميجابايت).',
        ];
    }
}
