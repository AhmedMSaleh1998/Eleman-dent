<?php


namespace App\Services;

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
        $eventsByYear = Event::selectRaw('YEAR(date) as year')
            // ->select('date', 'name', 'description') 
            ->orderBy('year', 'desc')
            ->get()
            ->groupBy('year');
        // $eventsByYear = Event::selectRaw('YEAR(date) as year')
        // ->select(
        //     'events.id',
        //     'events.image', // Include all non-aggregated columns here
        //     'events.date',
        //     'event_translations.name as event_name_translation'
        // )
        // ->leftJoin('event_translations', 'events.id', '=', 'event_translations.event_id')
        // // ->groupBy( 'events.image', 'events.date','event_name_translation') // Include all non-aggregated columns here
        // ->orderBy('events.date', 'desc')
        // ->get();

        // $eventsByYear = Event::select(
        //     DB::raw('YEAR(events.event_date) as year'),
        //     'events.*',
        //     'event_translations.name as event_name_translation'
        // )
        //     ->leftJoin('event_translations', 'events.id', '=', 'event_translations.event_id')
        //     ->groupBy('year', 'events.id')
        //     ->orderBy('year', 'desc')
        //     ->get();

        return $eventsByYear;
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
