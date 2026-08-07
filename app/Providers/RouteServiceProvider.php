<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/admin/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        // 60 طلب/دقيقة كانت منخفضة جداً لمتجر عام: تصفح الكتالوج وحده يستهلكها،
        // وزوار كُثر يشتركون في نفس الـ IP (شبكات المكاتب والموبايل) فيتحجبون جميعاً
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(300)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // خريطة الموقع بدون prefix حتى تكون على /sitemap.xml مباشرة —
            // يستهلكها بروكسي sitemap.php على دومين الفرونت
            Route::middleware('web')
                ->get('sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])
                ->name('sitemap');

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // كل روابط لوحة التحكم تحت /admin — التحميل المكرر بدون prefix كان
            // بيسجل كل route مرتين بنفس الاسم ويمنع route:cache
            Route::prefix('admin')
                ->middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }
}
