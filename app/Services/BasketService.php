<?php

namespace App\Services;

use App\Http\Resources\BasketResource;
use App\Repositories\CartItemRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BasketService extends BaseService
{

    public function __construct(
        CartItemRepository $repository,
        Request $request
    ) {
        parent::__construct($repository, $request);

        $this->with = [
            'product_size.product',
            'product_size.size',
        ];
    }

    public function getApi()
    {
        $data = $this->repository->get()->where('user_id', getCurrentUser())->where('order_id', null);
        return BasketResource::collection($data);
    }

    public function updateQty($id, $qty)
    {
        resolve(CartItemRepository::class)->update_qty($id, $qty);
    }

    public function destroyAll()
    {
        $data = $this->repository->where('user_id', getCurrentUser())->delete();
    }

    public function store($data)
    {
        $record = $this->repository->where('user_id', $data['user_id'])->where('product_id', $data['product_id'])->where('order_id', null)->first();

        if ($record) {
            $record->quantity += $data['quantity'];
            $record->update();
        } else {
            $record = $this->repository->create($data);
        }

        return $record;
    }
}
