<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * استقبال الفيديوهات الكبيرة على شكل قطع صغيرة (chunked upload).
 *
 * السيرفر/الـ CDN يقطع طلبات الرفع الطويلة، فبدل رفع الفيديو في طلب واحد
 * يقسمه المتصفح إلى قطع صغيرة كل منها طلب قصير مستقل. عند اكتمال كل
 * القطع تُدمج في ملف واحد، ويستلمه الحفظ النهائي عبر takeMergedVideo().
 */
class UploadChunkController extends Controller
{
    private const ALLOWED_MIMES = ['video/mp4', 'video/quicktime', 'video/webm', 'video/x-m4v'];
    private const MAX_TOTAL_BYTES = 102400 * 1024; // 100MB — نفس حد الفاليديشن

    public function store(Request $request)
    {
        $request->validate([
            'upload_id' => 'required|regex:/^[a-f0-9]{32}$/',
            'index'     => 'required|integer|min:0|max:1000',
            'total'     => 'required|integer|min:1|max:1000',
            'chunk'     => 'required|file|max:6144', // كل قطعة 6MB كحد أقصى
        ]);

        $uploadId = $request->input('upload_id');
        $index    = $request->integer('index');
        $total    = $request->integer('total');
        $baseDir  = storage_path('app/video_chunks');
        $dir      = $baseDir . '/' . $uploadId;

        if ($index === 0) {
            $this->cleanupStale($baseDir);
        }

        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $request->file('chunk')->move($dir, 'part_' . $index);

        // لسه فيه قطع ناقصة؟
        for ($i = 0; $i < $total; $i++) {
            if (!is_file($dir . '/part_' . $i)) {
                return response()->json(['done' => false, 'received' => $index]);
            }
        }

        // اكتملت القطع — دمج بالترتيب
        $merged = $dir . '/merged.bin';
        $out = fopen($merged, 'wb');
        for ($i = 0; $i < $total; $i++) {
            $part = $dir . '/part_' . $i;
            $in = fopen($part, 'rb');
            stream_copy_to_stream($in, $out);
            fclose($in);
            unlink($part);
        }
        fclose($out);

        // فحص النوع والحجم على الملف النهائي (الفاليديشن العادي لا يرى ملف القطع)
        $mime = mime_content_type($merged);
        if (!in_array($mime, self::ALLOWED_MIMES, true)) {
            $this->removeDir($dir);
            return response()->json([
                'done'    => false,
                'message' => 'صيغة الفيديو غير مدعومة — ارفع MP4 أو MOV أو WebM.',
            ], 422);
        }

        if (filesize($merged) > self::MAX_TOTAL_BYTES) {
            $this->removeDir($dir);
            return response()->json([
                'done'    => false,
                'message' => 'حجم الفيديو أكبر من الحد المسموح (100 ميجابايت).',
            ], 422);
        }

        return response()->json(['done' => true, 'token' => $uploadId]);
    }

    /**
     * حذف مجلدات رفع قديمة (أقدم من 24 ساعة) خلّفتها محاولات لم تكتمل.
     */
    private function cleanupStale(string $baseDir): void
    {
        foreach (glob($baseDir . '/*', GLOB_ONLYDIR) ?: [] as $old) {
            if (filemtime($old) < time() - 86400) {
                $this->removeDir($old);
            }
        }
    }

    private function removeDir(string $dir): void
    {
        foreach (glob($dir . '/*') ?: [] as $file) {
            @unlink($file);
        }
        @rmdir($dir);
    }
}
