<?php


namespace App\Services;

use App\Models\Payment;
use App\Repository\IRepository;
use App\Repositories\PaymentMethodRepository;
use App\Utils\FilterUtil;
use Illuminate\Http\Request;

class PaymentMethodService extends BaseService
{

    public function __construct(PaymentMethodRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function store($request)
    {
        $input = $request->validated();
        Payment::create([
            'en' => [
                'name' => $input['name_en'],
            ],
            'ar' => [
                'name' => $input['name_ar'],
            ],
        ]);
    }
}
