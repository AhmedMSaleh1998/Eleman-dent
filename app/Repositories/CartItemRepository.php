<?php

namespace App\Repositories;

use App\Models\CartItem;
use Illuminate\Container\Container as App;
//use Your Model

/**
 * Class CartItemRepository.
 */
class CartItemRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return CartItem::class;
    }

    public function getCartBasketsForUser($user_id)
   {
       return $this->model->where('user_id', $user_id)->where('order_id', null)->get();
   }

    public function update_qty($id, $qty)
    {
        $basket = $this->show($id);
        $data['quantity'] = $qty;
        $basket->update($data);
        return true;
    }
}
