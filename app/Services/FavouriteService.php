<?php


namespace App\Services;

use App\Http\Resources\FavouriteResource;
use App\Repositories\FavouriteRepository;
use Illuminate\Http\Request;

class FavouriteService extends BaseService
{

    public function __construct(FavouriteRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function getApi()
    {
        $data = $this->repository->where('user_id', getCurrentUser())->get();
        return FavouriteResource::collection($data);
    }

    public function store($request)
    {
        $favourite = $this->repository->where('product_id', '=', $request['product_id'])->where('user_id', '=', getCurrentUser())->first();

        if (!$favourite) {
            $favourite = $this->repository->create($request);
        }

        return $favourite;
    }

    public function destroy($product_id)
    {
        $favourite = $this->repository->where('product_id', '=', $product_id)->where('user_id', '=', getCurrentUser())->first();
        return $favourite->delete();
    }
}
