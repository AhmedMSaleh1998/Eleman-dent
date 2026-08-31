<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * استرجاع المنتجات التي حُفظت بدون ترجمات بسبب خطأ
     * "1406 Data too long for column 'title'" يوم 2026-08-31.
     *
     * البيانات الإنجليزية مستردة حرفيًا من الـ log (المحاولات الثلاث كانت
     * لنفس المنتج C-GL Surgical Loupes)، وتوضع نسخة منها في العربي مؤقتًا
     * حتى يستكملها المستخدم من لوحة التحكم. أي منتج آخر بلا ترجمة يأخذ
     * اسمًا مؤقتًا واضحًا. الميجريشن آمن لإعادة التشغيل: يضيف فقط ما ينقص.
     */
    public function up(): void
    {
        $now = now();

        $singleLine = 'C-GL Surgical Loupes Feature: The through-the-lens surgical loupe employs a classic optical structure with apochromatic design, ensuring edge-to-edge clarity and true-color fidelity without chromatic aberration.  The direct-view optical path aligns with natural eye habits, making it intuitive to use with a minimal learning curve.  Crafted with high-optical-grade glass lenses, multi-layer coatings, and built-in anti-fog & anti-fungal properties.  Lightweight design-constructed with high-strength lightweight alloys/composites for comfortable, secure wear even during extended use.';

        $multiLine = "C-GL Surgical Loupes Feature:\nThe through-the-lens surgical loupe employs a classic optical structure with apochromatic design, ensuring edge-to-edge clarity and true-color fidelity without chromatic aberration.\n\nThe direct-view optical path aligns with natural eye habits, making it intuitive to use with a minimal learning curve.\n\nCrafted with high-optical-grade glass lenses, multi-layer coatings, and built-in anti-fog & anti-fungal properties.\n\nLightweight design-constructed with high-strength lightweight alloys/composites for comfortable, secure wear even during extended use.";

        $recovered = [
            'name'             => 'C-GL Surgical Loupes C-GL35 3.5x',
            'title'            => $singleLine,
            'alt'              => 'C-GL Surgical Loupes C-GL35 3.5x',
            'warranty'         => null,
            'description'      => $multiLine,
            'description_meta' => $singleLine,
            'keywords_meta'    => $singleLine,
            'keywords'         => $singleLine,
        ];

        // صور المحاولات الثلاث الفاشلة كما وردت في الـ log
        $recoveredImages = ['1788168208.png', '1788168521.png', '1788168948.png'];

        foreach (['en', 'ar'] as $locale) {
            $orphans = DB::table('products')
                ->whereNotExists(function ($query) use ($locale) {
                    $query->select(DB::raw(1))
                        ->from('product_translations')
                        ->whereColumn('product_translations.product_id', 'products.id')
                        ->where('product_translations.locale', $locale);
                })
                ->get(['id', 'image']);

            foreach ($orphans as $product) {
                if (in_array($product->image, $recoveredImages, true)) {
                    $data = $recovered;
                } else {
                    $placeholder = $locale === 'ar'
                        ? 'منتج بحاجة لاستكمال البيانات #' . $product->id
                        : 'Incomplete product #' . $product->id;

                    $data = [
                        'name'             => $placeholder,
                        'title'            => $placeholder,
                        'alt'              => $placeholder,
                        'warranty'         => null,
                        'description'      => $placeholder,
                        'description_meta' => $placeholder,
                        'keywords_meta'    => $placeholder,
                        'keywords'         => $placeholder,
                    ];
                }

                DB::table('product_translations')->insert($data + [
                    'locale'     => $locale,
                    'product_id' => $product->id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    public function down(): void
    {
        // ميجريشن استرجاع بيانات — لا يوجد تراجع تلقائي حتى لا تُحذف
        // ترجمات ربما عدّلها المستخدم بعد التشغيل.
    }
};
