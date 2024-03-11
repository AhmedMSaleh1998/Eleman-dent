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
        $eventImage['image'] = uploadImage($eventImage['image'], 'events');
        $this->repository->create($eventImage);
    }

    public function update($request, $id)
    {
        $eventImage = $request->validated();
        if ($request->hasFile('image')) {
            $eventImage['image'] = uploadImage($eventImage['image'], 'events', 'event_images', $id);
        }
        $this->repository->update($id, $eventImage);
    }

    public function destroy($id)
    {
        $image = $this->repository->find($id);
        unlink(public_path('admin_assets/images/events/' . $image->image));
        $this->repository->destroy($id, $image);
    }
}
