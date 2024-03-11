<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\EventImageRequest;
use App\Http\Requests\UpdateEventImageRequest;
use App\Services\EventImageService;

class EventImageController extends BaseController
{
    public function __construct(EventImageService $service)
    {
        parent::__construct($service);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($event_id)
    {
        $eventImage = $this->service->get()->where('event_id', $event_id);
        return view('admin.eventImage.index', compact('eventImage', 'event_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($event_id)
    {
        return view('admin.eventImage.create', compact('event_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventImageRequest $request)
    {
        /* $productImage = $request->validated();
        $productImage['image'] = uploadImage($productImage['image'], 'products'); */
        $this->service->store($request);
        return redirect()->back()->with(['success' => 'Event Image added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = $this->service->show($id);
        return view('admin.eventImage.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eventImage = $this->service->show($id);
        return view('admin.eventImage.edit', compact('eventImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventImageRequest $request, $id)
    {
        $this->service->update($request, $id);
        return redirect()->back()->with(['success' => 'Event Image updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect()->back()->with(['success' => 'Event Image deleted successfully']);
    }
}
