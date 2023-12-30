<?php


namespace App\Helpers;


trait ShowHelper
{

    public function show($id)
    {
        return $this->getRecordData($id);
    }

    public function getRecordData($id)
    {
        return $this->repository->show($id, $this->with);
    }
}
