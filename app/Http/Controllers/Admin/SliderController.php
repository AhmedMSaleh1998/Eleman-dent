<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SliderRequest;
use App\Services\SliderService;

class SliderController extends BaseController
{
    public function __construct(SliderService $service)
    {
        parent::__construct($service);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = $this->service->getAll();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $slider = $request->validated();
        $slider['image'] = uploadImage($slider['image'], 'sliders');
        $this->service->store($slider);
        return redirect()->back()->with(['success' => 'تم إضافة الاسليدر بنجاح']);;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = $this->service->show($id);
        return view('admin.slider.edit', compact('slider', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
    {
        $slider = $request->validated();
        if ($request->hasFile('image')) {
            $slider['image'] = uploadImage($slider['image'], 'categories', 'categories', $id);
        }
        $this->service->update($id, $slider);
        return redirect()->back()->with(['success' => 'تم تعديل الاسليدر بنجاح']);
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
        return redirect(route('admin.slider.index'))->with(['success' => 'تم حذف الاسليدر بنجاح']);
    }
}
