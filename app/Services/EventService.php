<?php


namespace App\Services;

use App\Http\Resources\EventResource;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\DB;

class EventService extends BaseService
{
    public function __construct(EventRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    public function index()
    {
        $eventsByYear = Event::selectRaw('YEAR(events.date) as year, events.*, event_translations.name, event_translations.location, event_translations.description')
        ->join('event_translations', 'events.id', '=', 'event_translations.event_id')
        ->get()
        ->groupBy('year');

        $limitedEventsByYear = $eventsByYear->map(function ($events) {
        return $events->take(3); // Select only the first 3 events for each year
    });

    return $limitedEventsByYear;
    }

    public function getEventsPerYear($year)
    {
        $events = Event::whereYear('date', $year)->get();

        return $events;
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
