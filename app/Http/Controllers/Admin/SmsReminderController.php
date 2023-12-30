<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SmsReminderRequest;
use App\Services\SmsReminderService;

class SmsReminderController extends BaseController
{
    public function __construct(SmsReminderService $service)
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
        $smsReminders = $this->service->getAll();
        return view('admin.smsReminder.index', compact('smsReminders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.smsReminder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SmsReminderRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->back()->with(['success' => 'تم إضافة تذكير رسائل بنجاح']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $smsreminder = $this->service->show($id);
        return view('admin.smsreminder.edit', compact('smsreminder', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SmsReminderRequest $request, $id)
    {
        $category = $this->service->update($request, $id);
        return redirect()->back()->with(['success' => 'تم تعديل تذكير رسائل بنجاح']);
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
        return redirect(route('admin.smsreminder.index'))->with(['success' => 'تم حذف تذكير رسائل بنجاح']);
    }
}
