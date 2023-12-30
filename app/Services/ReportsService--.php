<?php


namespace App\Services;


use App\Models\Restaurant;
use App\Prototype\FilterMeta;
use App\Repository\ReportRepository;
use App\Utils\FilterUtil;
use App\Utils\OperatorUtil;
use App\Utils\OrderStatusUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsService extends BaseService
{

    public function __construct(ReportRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
        $this->filters = [
           'date' =>  new FilterMeta('orders.created_at', FilterUtil::DATE_BETWEEN),
           'orders.status' =>  new FilterMeta('orders.status', FilterUtil::EQUAL_FILTER, OrderStatusUtil::COMPLETED),
        ];
    }

    public function paginate($order = [])
    {
        $this->repository->changeModel(Restaurant::class);
        return parent::paginate($order);
    }
}
