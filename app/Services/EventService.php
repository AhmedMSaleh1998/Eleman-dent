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
        // كل الفعاليات مجمّعة بالسنة — من غير حد لعدد الفعاليات في السنة،
        // ومرتبة بالتاريخ (الأحدث أولاً) مش بترتيب الإضافة
        return Event::selectRaw('YEAR(events.date) as year, events.*, event_translations.name, event_translations.location, event_translations.description')
        ->join('event_translations', 'events.id', '=', 'event_translations.event_id')
        ->where('event_translations.locale', app()->getLocale())
        ->orderByDesc('events.date')
        ->get()
        ->groupBy('year');
    }

    public function getEventsPerYear($year)
    {
        $events = Event::whereYear('date', $year)->get();

        return $events;
    }

    public function store($request)
    {
        $input = $request->validated();

        // الوسيط الرئيسي للحدث: صورة أو فيديو — واحد بس مش الاتنين
        $image = null;
        $video = null;
        if ($input['media_type'] === 'video' && $request->hasFile('video')) {
            $video = uploadVideo($request->file('video'), 'events');
        } elseif ($input['media_type'] === 'video' && $request->filled('video_token')) {
            // الفيديوهات الكبيرة بتوصل قطع عبر UploadChunkController وهنا بنستلم الملف المدموج
            $video = takeMergedVideo($request->input('video_token'), 'events');
        } elseif ($request->hasFile('image')) {
            $image = uploadImage($request->file('image'), 'events');
        }

        Event::create([
            'image' => $image,
            'video' => $video,
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

        // الوسيط الرئيسي: صورة أو فيديو — واحد بس. رفع نوع جديد بيستبدل القديم
        // ويمسح ملفه من السيرفر. من غير ملف جديد بنسيب الحالي زي ما هو.
        $image = $event->image;
        $video = $event->video;

        if ($request->input('media_type') === 'video' && ($request->hasFile('video') || $request->filled('video_token'))) {
            $newVideo = $request->hasFile('video')
                ? uploadVideo($request->file('video'), 'events')
                : takeMergedVideo($request->input('video_token'), 'events');

            if ($newVideo) {
                deleteUploadedFile($event->video ? public_path('admin_assets/videos/events/' . $event->video) : null);
                deleteUploadedFile($event->image ? public_path('admin_assets/images/events/' . $event->image) : null);
                $video = $newVideo;
                $image = null;
            }
        } elseif ($request->input('media_type') === 'image' && $request->hasFile('image')) {
            // uploadImage بتمسح الصورة القديمة بنفسها لما نبعتلها الجدول والـ id
            $image = uploadImage($request['image'], 'events', 'events', $id);
            deleteUploadedFile($event->video ? public_path('admin_assets/videos/events/' . $event->video) : null);
            $video = null;
        }

        $event->update([
            'image' => $image,
            'video' => $video,
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
