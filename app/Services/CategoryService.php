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
        $category = $request->validated();
        if ($request->hasFile('image')) {
            $category['image'] = uploadImage($category['image'], 'categories', 'categories', $id);
        }
        $this->repository->update($id, $category);
    }

    
}
