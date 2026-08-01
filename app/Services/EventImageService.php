<?php


namespace App\Services;

use App\Repositories\EventImageRepository;
use Illuminate\Http\Request;

class EventImageService extends BaseService
{

    public function __construct(EventImageRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function get()
    {
        $data = $this->repository->get();
        return $data;
    }

    public function store($request)
    {
        $eventImage = $request->validated();
        $eventImage['image'] = $this->upload($request->file('image'), $eventImage['type']);
        $this->repository->create($eventImage);
    }

    public function update($request, $id)
    {
        $record = $this->repository->find($id);
        $eventImage = $request->validated();

        if ($request->hasFile('image')) {
            // بنمسح الملف القديم بنفسنا لأن النوع ممكن يكون اتغيّر (صورة ← فيديو) والمجلد بيختلف
            deleteUploadedFile($record->file_path);
            $eventImage['image'] = $this->upload($request->file('image'), $eventImage['type']);
        } else {
            // من غير ملف جديد يفضل الملف والنوع القديم زي ما هما
            unset($eventImage['image']);
            $eventImage['type'] = $record->type;
        }

        $this->repository->update($id, $eventImage);
    }

    public function destroy($id)
    {
        $image = $this->repository->find($id);
        deleteUploadedFile($image->file_path);
        $this->repository->destroy($id, $image);
    }

    /** رفع الملف في المجلد الصح حسب نوعه وإرجاع اسم الملف */
    private function upload($file, $type)
    {
        return $type === 'video'
            ? uploadVideo($file, 'events')
            : uploadImage($file, 'events');
    }
}

