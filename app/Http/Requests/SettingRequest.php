<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'location_one' => 'required',
            'location_two' => 'required',
            'src_one' => 'required',
            'src_two' => 'required',
            'phone_one' => 'required',
            'phone_two' => 'nullable',
            'email' => 'required|email',
            'address_one_ar' => 'nullable|string',
            'address_one_en' => 'nullable|string',
            'address_two_ar' => 'nullable|string',
            'address_two_en' => 'nullable|string',
            'working_hours_ar' => 'nullable|string|max:255',
            'working_hours_en' => 'nullable|string|max:255',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'whatsapp' => 'nullable',
            'youtube' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'keywords_ar' => 'nullable|string',
            'keywords_en' => 'nullable|string',
            'privacy_ar' => 'nullable|string',
            'privacy_en' => 'nullable|string',
            'terms_ar' => 'required|string',
            'terms_en' => 'required|string',
            'about_us_ar' => 'nullable|string',
            'about_us_en' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp,svg|max:2048',
        ];
    }
}
