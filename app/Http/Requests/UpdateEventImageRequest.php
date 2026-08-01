<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isVideo = $this->input('type') === 'video';

        return [
            'type'      => 'required|in:image,video',
            'image'     => $isVideo
                ? 'nullable|file|mimetypes:video/mp4,video/quicktime,video/webm,video/x-m4v|max:102400'
                : 'nullable|image|max:10240',
            'event_id'  => 'required|integer',
            'alt'       => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return eventMediaMessages();
    }
}
