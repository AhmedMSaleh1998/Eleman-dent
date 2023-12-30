<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AboutRequest;
use App\Services\AboutService;

class AboutController extends BaseController
{
    public function __construct(AboutService $service)
    {
        parent::__construct($service);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = $this->service->first();
        return view('admin.about.index', compact('about'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request, $id)
    {
        $model = $this->service->update($id, $request->validated());
        return redirect()->back();
    }
}
