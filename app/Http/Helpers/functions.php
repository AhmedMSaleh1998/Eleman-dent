<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

if (!function_exists('safeSendMail')) {
    /**
     * إرسال الإيميل كخدمة مستقلة — لو خدمة الميل مش شغّالة ما توقفش باقي العملية.
     * بترجع true لو اتبعت بنجاح، false لو حصل خطأ (والخطأ بيتسجّل في اللوج بس).
     *
     * @param  \Closure  $callback  الكود المسؤول عن الإرسال (Mail::to()->send(...))
     * @param  string    $context   وصف مختصر للعملية للّوج
     */
    function safeSendMail(\Closure $callback, string $context = 'mail'): bool
    {
        try {
            $callback();
            return true;
        } catch (\Throwable $e) {
            Log::warning('Mail sending failed (' . $context . '): ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('getCurrentUser')) {
    function getCurrentUser()
    {
       return  Auth::user()->id ?? null;
        // return resolve(\App\Services\AuthService::class)->getAuthUser('api')->id ?? null;
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($image, $path, $table = null, $id = null)
    {
        if ($table) {
            $old_image = \DB::table($table)->where('id', $id)->first()->image;
            $old_path = $old_image ? public_path('admin_assets/images/' . $path . '/' . $old_image) : null;

            $old_path &&  file_exists($old_path) ? unlink($old_path) : '';
        }
        //unlink(public_path('admin_assets/images/' . $path . '/' . $image));
        $name  = time() . '.' . $image->extension();
        $image->move(public_path('admin_assets/images/' . $path), $name);
        return $name;
    }
}

if (!function_exists('uploadVideo')) {
    /**
     * رفع فيديو في public/admin_assets/videos/{$path} وإرجاع اسم الملف.
     *
     * @param  \Illuminate\Http\UploadedFile  $video  الملف المرفوع
     * @param  string  $path  اسم المجلد داخل videos (مثال: events)
     * @return string  اسم الملف الجديد
     */
    function uploadVideo($video, $path)
    {
        // uniqid عشان رفع أكتر من فيديو في نفس الثانية ما يمسحش بعضه
        $name = time() . '_' . uniqid() . '.' . $video->extension();
        $video->move(public_path('admin_assets/videos/' . $path), $name);

        return $name;
    }
}

if (!function_exists('deleteUploadedFile')) {
    /**
     * حذف ملف مرفوع من على السيرفر لو موجود (من غير ما يلمس قاعدة البيانات).
     *
     * @param  string|null  $fullPath  المسار الكامل للملف
     */
    function deleteUploadedFile($fullPath)
    {
        if ($fullPath && file_exists($fullPath) && is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}

if (!function_exists('eventMediaMessages')) {
    /**
     * رسائل التحقق الموحّدة لرفع صور/فيديوهات الأحداث.
     */
    function eventMediaMessages()
    {
        return [
            'type.required'   => 'اختر نوع الملف: صورة أو فيديو.',
            'type.in'         => 'نوع الملف غير صحيح.',
            'image.required'  => 'اختر الملف المراد رفعه.',
            'image.image'     => 'الملف المرفوع لازم يكون صورة (JPG أو PNG أو WebP).',
            'image.mimetypes' => 'صيغة الفيديو غير مدعومة — استخدم MP4 أو MOV أو WebM.',
            'image.max'       => 'حجم الملف كبير جداً — الحد الأقصى 10 ميجا للصورة و100 ميجا للفيديو.',
        ];
    }
}

if (!function_exists('maxUploadSizeBytes')) {
    /**
     * أقصى حجم ملف يقدر السيرفر يستقبله فعلياً = الأصغر بين upload_max_filesize و post_max_size.
     */
    function maxUploadSizeBytes()
    {
        $toBytes = function ($value) {
            $value = trim((string) $value);
            if ($value === '' || $value === '0') {
                return PHP_INT_MAX; // 0 أو فاضي يعني بدون حد
            }

            $unit   = strtolower(substr($value, -1));
            $number = (int) $value;

            switch ($unit) {
                case 'g':
                    return $number * 1024 * 1024 * 1024;
                case 'm':
                    return $number * 1024 * 1024;
                case 'k':
                    return $number * 1024;
                default:
                    return $number;
            }
        };

        return min(
            $toBytes(ini_get('upload_max_filesize')),
            $toBytes(ini_get('post_max_size'))
        );
    }
}

if (!function_exists('postTooLargeMessage')) {
    /**
     * رسالة موحّدة لما يتجاوز الملف حد الرفع بتاع PHP.
     */
    function postTooLargeMessage()
    {
        return 'حجم الملف المرفوع أكبر من الحد المسموح به على السيرفر (' . maxUploadSizeLabel() . '). '
            . 'اضغط الفيديو أو اختر ملف أصغر.';
    }
}

if (!function_exists('maxUploadSizeLabel')) {
    /**
     * نفس الحد السابق لكن كنص عربي جاهز للعرض، مثال: "100 ميجابايت".
     */
    function maxUploadSizeLabel()
    {
        return round(maxUploadSizeBytes() / 1048576) . ' ميجابايت';
    }
}

if (!function_exists('search')) {
    function search($table, $name, $description = null)
    {
        $data = DB::table($table)->where('name', $name)->orWhere('description', $description)->get();
    }
}
