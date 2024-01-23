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
        return [
            'name_ar'           => 'required',
            'name_en'           => 'required',
            'image'             => 'nullable|image',
            'description_ar'  => 'required',
            'description_en'  => 'required',
            'location_ar'          => 'required|string',
            'location_en'          => 'required|string',
            'date'             => 'required|date|after:today',

        ];
    }
}
