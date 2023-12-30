<?php


namespace App\Services;


use App\Filters\NumberFilter;
use App\Helpers\HandelEditHasManyRelation;
use App\Prototype\FilterMeta;
use App\Repository\BaseRepository;
use App\Repository\FeatureRepository;
use App\Repository\MenuRepository;
use App\Utils\FilterUtil;
use Illuminate\Http\Request;


class MenuService extends BaseService
{

    public function __construct(MenuRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
        $this->with = [
            'features','additions'
        ];

        if (request('restaurant_id')) {
            $this->filters['restaurant_id']  = new FilterMeta('restaurant_id', FilterUtil::NUMBER_FILTER, request('restaurant_id'));
        }
    }


    public function getFormData()
    {
        return ['features' => $this->repository->getFeatures()];
    }

   public function store($request)
   {
       $record = parent::store($request->only('name'));
       $record->features()->attach($request->get('features'));
       $record->additions()->createMany(
           $request->get('additions')
       );
       return $record;
   }

    public function update($id, $request)
    {
        $record = parent::update($id, $request->only('name'));


        $record->features()->sync($request->get('features'));

        app()->makeWith(HandelEditHasManyRelation::class, ['repository' => $this->repository])
            ->handel($id, $request->get('additions'), ['name']);

        return $record;
    }
}
