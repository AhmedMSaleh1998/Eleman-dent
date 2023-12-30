<?php


namespace App\Services;

use App\Http\Resources\CouponResource;
use App\Repositories\CouponUserRepository;
use App\Repositories\CouponRepository;
use Illuminate\Http\Request;
use Exception;

class CouponService extends BaseService
{

    private $couponUserRepository;
    public function __construct(CouponRepository $repository, CouponUserRepository $couponUserRepository, Request $request)
    {
        parent::__construct($repository, $request);
        $this->couponUserRepository = $couponUserRepository;
    }

    public function checkCoupon($request)
    {
        $input = $request->all();
        $coupon = $this->repository->where('code', $input['code'])->where('status', 1)->first();

        if ($coupon) {
            if ($coupon->valid_to >= date('Y-m-d') && $coupon->valid_from <= date('Y-m-d')) {
                if ($this->couponUserRepository->where('user_id', getCurrentUser())->where('coupon_id', $coupon->id)->count() < $coupon->uses) {
                    return $coupon;
                }
            }
        }

        return [];
    }
}
