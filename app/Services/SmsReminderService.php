<?php


namespace App\Services;

use App\Repositories\SmsReminderRepository;
use Illuminate\Http\Request;

class SmsReminderService extends BaseService
{

    public function __construct(SmsReminderRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function update($request, $id)
    {
        $product = $this->show($id);

        $record = $request->validated();
        if ($request->notify_order == 'on') {
            $record['notify_order'] = 1;
        } else {
            $record['notify_order'] = 0;
        }

        if ($request->notify_payment == 'on') {
            $record['notify_payment'] = 1;
        } else {
            $record['notify_payment'] = 0;
        }
        parent::update($id, $record);
    }
}
