<?php


namespace App\Services;

use App\Repositories\ProductImageRepository;
use Illuminate\Http\Request;

class ProductImageService extends BaseService
{

    public function __construct(ProductImageRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function get()
    {
        $data = $this->repository->get();
        return $data;
    }

    public function store($request)
    {
        $prouctImage = $request->validated();
        $prouctImage['image'] = uploadImage($prouctImage['image'], 'products');
        $this->repository->create($prouctImage);
    }

    public function update($request, $id)
    {
        $prouctImage = $request->validated();
        if ($request->hasFile('image')) {
            $prouctImage['image'] = uploadImage($prouctImage['image'], 'products', 'product_images', $id);
        }
        $this->repository->update($id, $prouctImage);
    }

    public function destroy($id)
    {
        $image = $this->repository->find($id);
        unlink(public_path('admin_assets/images/products/' . $image->image));
        $this->repository->destroy($id, $image);
    }
}
