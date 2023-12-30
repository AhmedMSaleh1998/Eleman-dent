<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\AddressRequest;
use App\Services\AddressService;

class AddressController extends BaseController
{
    public function __construct(AddressService $service)
    {
        parent::__construct($service);
    }

    /**
     * Display a listing of the resource.
     */
    public function index($user_id)
    {
        $addresses = $this->service->getUserAddresses($user_id);
        return view('admin.address.index', compact('addresses', 'user_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($user_id)
    {
        $districts = $this->service->getDistrictsForAddress();
        return view('admin.address.create', compact('user_id', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.address.index', $request->user_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $address = $this->service->show($id);
        return view('admin.address.show', compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = $this->service->getRecordData($id);
        $districts = $this->service->getDistrictsForAddress();
        return view('admin.address.create', ['districts' => $districts, 'record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, string $id)
    {
        $this->service->update($id, $request->validated());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = $this->service->show($id);
        $this->service->tempDestroy($id);
        return redirect(route('admin.address.index', $address->user_id))->with(['success' => 'تم حذف العنوان بنجاح']);
    }
}
