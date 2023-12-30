<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\SettingRequest;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function __construct(SettingService $service)
    {
        parent::__construct($service);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = $this->service->first();
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->back()->with(['success' => 'تم إضافة الإعدادات بنجاح']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, $id)
    {
        $model = $this->service->update($id, $request->validated());
        return redirect()->back()->with(['success' => 'تم تعديل الإعدادات بنجاح']);
    }
}
