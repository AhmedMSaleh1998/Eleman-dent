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
            'location' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address_ar' => 'nullable|string',
            'address_en' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'whatsapp' => 'nullable',
            'youtube' => 'nullable|url',
            'keywords_ar' => 'nullable|string',
            'keywords_en' => 'nullable|string',
            'privacy_ar' => 'nullable|string',
            'privacy_en' => 'nullable|string',
            'terms_ar' => 'required|string',
            'terms_en' => 'required|string',
            'about_us_ar' => 'nullable|string',
            'about_us_en' => 'nullable|string',

        ];
    }
}
