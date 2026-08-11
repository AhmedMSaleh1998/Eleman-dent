<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    private const SITE_URL = 'https://elemandental.com';

    /**
     * خريطة الموقع تُبنى من قاعدة البيانات مباشرة حتى تظهر المنتجات
     * الجديدة تلقائياً بدون إعادة رفع للفرونت. تُكاش لمدة ساعة.
     */
    public function index()
    {
        // v2: تمت إضافة صور المنتجات — تغيير المفتاح يجدد الكاش تلقائياً بعد الرفع
        $xml = Cache::remember('sitemap.xml.v2', 3600, fn () => $this->build());

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    private function build()
    {
        $urls = [];

        foreach (['', '/products', '/brands', '/categories', '/aboutUs', '/contactUs', '/events'] as $path) {
            $urls[] = ['loc' => self::SITE_URL . ($path ?: '/'), 'priority' => $path === '' ? '1.0' : '0.8'];
        }

        $categories = Category::where('status', 1)->with('translations')->get();
        foreach ($categories as $category) {
            $slug = $this->slug($category, 'name');
            if (!$slug) continue;
            $urls[] = [
                'loc' => self::SITE_URL . '/category/' . rawurlencode($slug),
                'lastmod' => optional($category->updated_at)->toDateString(),
                'priority' => '0.7',
            ];
        }

        $products = Product::active()->with(['translations', 'productImage'])->orderBy('seq')->get();
        foreach ($products as $product) {
            $slug = $this->slug($product, 'name') ?: (string) $product->id;

            // صور المنتج تدخل الخريطة حتى تظهر في بحث الصور (مصدر زيارات مهم للمعدات)
            $images = [];
            if ($product->image) {
                $images[] = asset('admin_assets/images/products/' . $product->image);
            }
            foreach ($product->productImage as $extra) {
                $images[] = asset('admin_assets/images/products/' . $extra->image);
            }

            $urls[] = [
                'loc' => self::SITE_URL . '/products/' . rawurlencode($slug),
                'lastmod' => optional($product->updated_at)->toDateString(),
                'priority' => '0.9',
                'images' => array_slice(array_values(array_unique($images)), 0, 10),
            ];
        }

        $out = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $out .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">' . "\n";
        foreach ($urls as $url) {
            $out .= "  <url>\n";
            $out .= '    <loc>' . htmlspecialchars($url['loc'], ENT_XML1) . "</loc>\n";
            if (!empty($url['lastmod'])) {
                $out .= '    <lastmod>' . $url['lastmod'] . "</lastmod>\n";
            }
            $out .= '    <priority>' . $url['priority'] . "</priority>\n";
            foreach ($url['images'] ?? [] as $image) {
                $out .= "    <image:image>\n";
                $out .= '      <image:loc>' . htmlspecialchars($image, ENT_XML1) . "</image:loc>\n";
                $out .= "    </image:image>\n";
            }
            $out .= "  </url>\n";
        }
        $out .= '</urlset>';

        return $out;
    }

    // الروابط في الفرونت مبنية من الاسم الإنجليزي، فنطابق نفس منطق slugify في src/app/lib/slug.js
    private function slug($model, $attribute)
    {
        $text = optional($model->translate('en'))->$attribute
            ?: optional($model->translate('ar'))->$attribute;
        if (!$text) return '';

        $text = mb_strtolower(trim($text), 'UTF-8');
        $text = preg_replace('/[\x{064B}-\x{0652}]/u', '', $text);   // التشكيل العربي
        $text = preg_replace('/[^\p{L}\p{N}\s-]/u', '', $text);
        $text = preg_replace('/\s+/u', '-', $text);
        $text = preg_replace('/-+/', '-', $text);

        return trim($text, '-');
    }
}
