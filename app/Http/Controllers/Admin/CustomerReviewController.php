<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CustomerReviewRequest;
use App\Services\CustomerReviewService;

class CustomerReviewController extends BaseController
{

    public function __construct(CustomerReviewService $service)
    {
        parent::__construct($service);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = $this->service->get();
        return view('admin.review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.review.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerReviewRequest $request)
    {
        $this->service->store($request);
        return redirect()->back()->with(['success' => 'Event added successfully']);;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $review = $this->service->show($id);
        return view('admin.review.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $review = $this->service->show($id);
        return view('admin.review.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerReviewRequest $request, $id)
    {
        $this->service->update($request, $id);
        return redirect()->back()->with(['success' => 'Review updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->service->destroy($id);
        return redirect(route('admin.review.index'))->with(['success' => 'Review deleted successfully']);
    }
}
