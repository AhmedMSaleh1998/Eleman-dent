<?php


namespace App\Services;


use App\Helpers\HandelEditHasManyRelation;
use App\Repository\FeatureRepository;
use Illuminate\Http\Request;


class FeatureService extends BaseService
{

    public function __construct(FeatureRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
        $this->with = [
            'options'
        ];
    }


    public function update($id, $request)
    {
        $this->repository->update($id, $request->except('options'));

        app()->makeWith(HandelEditHasManyRelation::class, ['repository' => $this->repository])
            ->handel($id,  $request->get('options'), ['name']);
        return $this->show($id, $this->with);
    }


}
