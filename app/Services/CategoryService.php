<?php


namespace App\Services;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryService extends BaseService
{

    public function __construct(CategoryRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function store($request)
    {
        $input = $request->validated();
        $input['image'] = uploadImage($input['image'], 'categories');
        Category::create([
            'image' => $input['image'],
            'parent_id' => $input['parent_id'] ?? null,
            'en' => [
                'name' => $input['name_en'],
                'title' => $input['title_en'],
                'alt' => $input['alt_en'],
                'description' => $input['description_en'],
                'description_meta' => $input['description_meta_en'],
                'keywords_meta' => $input['keywords_meta_en'],
                'keywords' => $input['keywords_en'],

            ],
            'ar' => [
                'name' => $input['name_ar'],
                'title' => $input['title_ar'],
                'alt' => $input['alt_ar'],
                'description' => $input['description_ar'],
                'description_meta' => $input['description_meta_ar'],
                'keywords_meta' => $input['keywords_meta_ar'],
                'keywords' => $input['keywords_ar'],

            ],
        ]);
    }

    public function update($request, $id)
    {
        $category = $this->show($id);

        if ($request->hasFile('image')) {
            $image = uploadImage($request['image'], 'categories', 'categories', $id);
        }
        $category->update([
            'image' => $image ?? $category->image,
            'parent_id' => $request['parent_id'] ?? null,
            'en' => [
                'name' => $request['name_en'],
                'title' => $request['title_en'],
                'alt' => $request['alt_en'],
                'description' => $request['description_en'],
                'description_meta' => $request['description_meta_en'],
                'keywords_meta' => $request['keywords_meta_en'],
                'keywords' => $request['keywords_en'],

            ],
            'ar' => [
                'name' => $request['name_ar'],
                'title' => $request['title_ar'],
                'alt' => $request['alt_ar'],
                'description' => $request['description_ar'],
                'description_meta' => $request['description_meta_ar'],
                'keywords_meta' => $request['keywords_meta_ar'],
                'keywords' => $request['keywords_ar'],

            ],
        ]);
    }

    /**
     * الأقسام الرئيسية النشطة مع فروعها (للـ API)
     */
    public function tree()
    {
        return Category::with('translations')
            ->where('status', 1)
            ->whereNull('parent_id')
            ->get();
    }

    /**
     * قائمة مسطحة بكل الأقسام بترتيب شجري (لاختيار الأب في الأدمن)
     * مع استبعاد القسم نفسه وكل فروعه عند التعديل لمنع الحلقات
     */
    public function parentOptions($exceptId = null)
    {
        $all = Category::with('translations')->get();

        $excluded = [];
        if ($exceptId) {
            $current = $all->firstWhere('id', (int) $exceptId);
            if ($current) {
                $excluded = array_merge([$current->id], $current->descendantIds());
            }
        }

        $options = [];
        $walk = function ($parentId, $depth) use (&$walk, $all, $excluded, &$options) {
            foreach ($all as $category) {
                $categoryParent = $category->parent_id === null ? null : (int) $category->parent_id;
                if ($categoryParent !== $parentId) {
                    continue;
                }
                if (in_array($category->id, $excluded)) {
                    continue;
                }
                $nameAr = optional($category->translate('ar'))->name;
                $nameEn = optional($category->translate('en'))->name;
                $options[] = [
                    'id' => $category->id,
                    'depth' => $depth,
                    'name' => trim(($nameAr ?? '') . ' — ' . ($nameEn ?? ''), ' —'),
                ];
                $walk($category->id, $depth + 1);
            }
        };
        $walk(null, 0);

        return $options;
    }
}
