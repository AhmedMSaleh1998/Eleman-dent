<?php


namespace App\Services;

use App\Repositories\ProductSizeRepository;
use App\Repositories\SizeRepository;
use Illuminate\Http\Request;

class ProductSizeService extends BaseService
{

    private $sizeRepository;

    public function __construct(ProductSizeRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function getProductSizes($product_id)
    {
        $data = $this->repository->where('product_id', $product_id)->get();
        return $data;
    }
    public function allSizes()
    {
        $data = $this->sizeRepository->get();
        return $data;
    }
}
