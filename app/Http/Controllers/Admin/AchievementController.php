<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AchievementRequest;
use App\Http\Requests\CityRequest;
use App\Services\AchievementService;

class AchievementController extends BaseController
{
    public function __construct(AchievementService $service)
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
        $achievements = $this->service->getAll();
        // dd($achievements);
        return view('admin.achievement.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.achievement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AchievementRequest $request)
    {
        $this->service->store($request);
        return redirect()->back()->with(['success' => 'Achievement Added Successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $achievement = $this->service->show($id);
        return view('admin.achievement.edit', compact('achievement', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AchievementRequest $request, $id)
    {
        $achievement = $this->service->update($id, $request);
        return redirect()->back()->with(['success' => 'Achievement Edited Successfully']);
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
        return redirect(route('admin.achievement.index'))->with(['success' => 'Achievement Deleted Successfully']);
    }
}
