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

    
}
