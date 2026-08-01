<?php

namespace App\Exceptions;

use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        /*
         * PHP بيرفض الطلب كله لو حجمه أكبر من post_max_size قبل ما يوصل للفاليديشن.
         * الطلبات العادية بترجع صفحة errors/413 والـ API بترجع JSON.
         * (السيشن لسه مش بدأت هنا لأن ValidatePostSize بيشتغل قبل StartSession،
         *  فمينفعش نستخدم redirect()->back()->with())
         */
        $this->renderable(function (PostTooLargeException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json(['message' => postTooLargeMessage()], 413);
            }
        });
    }
}
