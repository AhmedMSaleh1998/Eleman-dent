<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductImageRequest;
use App\Services\ProductImageService;

class ProductImageController extends BaseController
{
    public function __construct(ProductImageService $service)
    {
        parent::__construct($service);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        $projectImage = $this->service->get()->where('product_id', $product_id);
        return view('admin.productImage.index', compact('projectImage', 'product_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        return view('admin.productImage.create', compact('product_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductImageRequest $request)
    {
        /* $productImage = $request->validated();
        $productImage['image'] = uploadImage($productImage['image'], 'products'); */
        $this->service->store($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->service->show($id);
        return view('admin.productImage.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productImage = $this->service->show($id);
        return view('admin.productImage.edit', compact('productImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductImageRequest $request, $id)
    {
        /* $product = $request->validated();
        $product['image'] = uploadImage($product['image'], 'products', 'product_images', $id); */
        $this->service->update($request, $id);
        return redirect()->back();
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
        return redirect()->back();
    }
}
