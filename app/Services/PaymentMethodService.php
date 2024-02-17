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
        $record = $request->validated();
        Payment::create([
            'en' => [
                'name' => $record['name_en'],
            ],
            'ar' => [
                'name' => $record['name_ar'],
            ],
        ]);

        return $record;
    }

    public function update($request, $id)
    {
        $payment = $this->show($id);

        $payment->update([
            'en' => [
                'name' => $request['name_en'],
            ],
            'ar' => [
                'name' => $request['name_ar'],
            ],
        ]);
        return $payment;
    }
}
