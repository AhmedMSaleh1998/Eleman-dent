<?php


namespace App\Services;

use App\Prototype\FilterMeta;

use App\Repository\IRepository;
use App\Repository\OptionRepository;
use App\Utils\FilterUtil;

class OptionService extends BaseService
{

    public function __construct(OptionRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);

        $this->filters = [
            'feature_id' => new FilterMeta('feature_id',FilterUtil::NUMBER_FILTER, $request->feature_id),
        ];
    }

}
