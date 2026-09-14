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
        unset($eventImage['video_token']);
        $eventImage['image'] = $this->resolveUpload($request, $eventImage['type']);
        $this->repository->create($eventImage);
    }

    public function update($request, $id)
    {
        $record = $this->repository->find($id);
        $eventImage = $request->validated();
        unset($eventImage['video_token']);

        $newFile = $this->resolveUpload($request, $eventImage['type']);
        if ($newFile) {
            // بنمسح الملف القديم بنفسنا لأن النوع ممكن يكون اتغيّر (صورة ← فيديو) والمجلد بيختلف
            deleteUploadedFile($record->file_path);
            $eventImage['image'] = $newFile;
        } else {
            // من غير ملف جديد يفضل الملف والنوع القديم زي ما هما
            unset($eventImage['image']);
            $eventImage['type'] = $record->type;
        }

        $this->repository->update($id, $eventImage);
    }

    /**
     * استلام الملف الجديد: مرفوع مباشرة في الطلب، أو فيديو كبير وصل
     * قطعًا عبر UploadChunkController ومعنا توكنه.
     *
     * @return string|null اسم الملف الجديد أو null لو مفيش ملف جديد
     */
    private function resolveUpload($request, $type)
    {
        if ($request->hasFile('image')) {
            return $this->upload($request->file('image'), $type);
        }

        if ($type === 'video' && $request->filled('video_token')) {
            return takeMergedVideo($request->input('video_token'), 'events');
        }

        return null;
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

