<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
            'description' => 'nullable',
            'policy' => 'nullable',
            'title_one' => 'nullable',
            'value_one' => 'nullable',
            'title_two' => 'nullable',
            'value_two' => 'nullable',
            'title_three' => 'nullable',
            'value_three' => 'nullable',
            'title_four' => 'nullable',
            'value_four' => 'nullable',
        ];
    }
}
