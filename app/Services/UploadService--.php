<?php


namespace App\Services;


use App\Helpers\HandelEditHasManyRelation;
use App\Repository\BaseRepository;
use App\Repository\FeatureRepository;
use App\Repository\UploadRepository;
use Illuminate\Http\Request;


class UploadService extends BaseService
{

    public function __construct(UploadRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }


    public function uploadPhoto($photo, $mediaType)
    {
        $name = time().uniqid().'.'.$photo->extension();
        $photo->move(public_path('uploads/'.$mediaType), $name);
        return $this->repository->create([
            'name' => $photo->getClientOriginalName(),
            'path' => $name,
            'media_type' => $mediaType
        ]);

    }


}
