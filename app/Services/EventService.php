<?php


namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Repositories\EventRepository;

class EventService extends BaseService
{
    public function __construct(EventRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
       
    }

    public function store($request)
    {
        $input = $request->validated();
        $input['image'] = uploadImage($input['image'], 'events');
        Event::create([
            'image' => $input['image'],
            'date' => $input['date'],

            'en' => [
                'name' => $input['name_en'],
                'description' => $input['description_en'],
                'location' => $input['location_en'],
            ],
            'ar' => [
                'name' => $input['name_ar'],
                'description' => $input['description_ar'],
                'location' => $input['location_ar'],

            ],
        ]);
    }

    public function update($request, $id)
    {
        $event = $this->show($id);

        if ($request->hasFile('image')) {
            $image = uploadImage($request['image'], 'events', 'events', $id);
        }
        $event->update([
            'image' => $image ?? $event->image,
            'date' => $request['date'],

            'en' => [
                'name' => $request['name_en'],
                'description' => $request['description_en'],
                'location' => $request['location_en'],
            ],
            'ar' => [
                'name' => $request['name_ar'],
                'description' => $request['description_ar'],
                'location' => $request['location_ar'],

            ],
        ]);
    }

    
}
