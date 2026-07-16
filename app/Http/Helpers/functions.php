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

if (!function_exists('search')) {
    function search($table, $name, $description = null)
    {
        $data = DB::table($table)->where('name', $name)->orWhere('description', $description)->get();
    }
}
