<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function __construct(ProductService $service)
    {
        parent::__construct($service);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->service->getAdminList($request);
        $data = $this->service->getFormData();
        return view('admin.product.index', compact('products', 'data'));
    }

    /**
     * Move selected products to another category at once.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bulkMoveCategory(Request $request)
    {
        $count = $this->service->bulkMoveCategory($request);
        return redirect()->route('admin.product.index')->with(['success' => 'تم نقل ' . $count . ' منتج إلى القسم المحدد بنجاح']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->service->getFormData();
        return view('admin.product.create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $this->service->store($request);
        return redirect()->back()->with(['success' => 'تم إضافة المنتج بنجاح']);;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->service->show($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->service->getFormData();
        $product = $this->service->getRecordData($id);
        return view('admin.product.edit', compact('product', 'id', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $this->service->update($request, $id);
        return redirect()->back()->with(['success' => 'تم تعديل المنتج بنجاح']);
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
        return redirect(route('admin.product.index'))->with(['success' => 'تم حذف المنتج بنجاح']);
    }
}
