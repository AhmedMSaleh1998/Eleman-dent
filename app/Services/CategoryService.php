<?php


namespace App\Services;

use App\Http\Resources\CategoryResource;
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
        $category = $request->validated();
        $category['image'] = uploadImage($category['image'], 'categories');
        $this->repository->create($category);
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
