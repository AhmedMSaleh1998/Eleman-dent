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
        // dd($setting);
        return view('admin.setting.index', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SettingRequest $request)
    {
        // dd($request->all());
        $this->service->store($request->validated());
        return redirect()->back()->with(['success' => 'Setting saved successfully' ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, $id)
    {
        $model = $this->service->updateSetting($request,$id);
        return redirect()->back()->with(['success' => 'Setting saved successfully' ]);
    }
}
