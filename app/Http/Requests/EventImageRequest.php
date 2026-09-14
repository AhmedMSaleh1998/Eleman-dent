<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventImageRequest extends FormRequest
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
        // الحقل اسمه image في الحالتين لأنه بيتخزن في نفس العمود، والنوع هو اللي بيفرّق
        $isVideo = $this->input('type') === 'video';

        return [
            'type'         => 'required|in:image,video',
            'image'        => $isVideo
                ? 'required_without:video_token|nullable|file|mimetypes:video/mp4,video/quicktime,video/webm,video/x-m4v|max:102400'
                : 'required|image|max:10240',
            // الفيديوهات الكبيرة بتترفع قطع عبر UploadChunkController وبيوصل هنا توكن بدل الملف
            'video_token'  => 'nullable|regex:/^[a-f0-9]{32}$/',
            'event_id'     => 'required|integer',
            'alt'          => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return eventMediaMessages();
    }
}
