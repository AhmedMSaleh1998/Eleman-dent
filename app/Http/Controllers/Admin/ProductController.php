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
     * Quick inline update for the product display order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateSeq(Request $request, $id)
    {
        $validated = $request->validate(['seq' => 'required|integer|min:0']);
        $this->service->updateSeq($id, $validated['seq']);
        return response()->json(['success' => true, 'seq' => (int) $validated['seq']]);
    }

    /**
     * Quick inline update for the product price or quantity.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateField(Request $request, $id)
    {
        $validated = $request->validate([
            'field' => 'required|in:price,quantity',
            'value' => 'required|numeric|min:0',
        ]);
        $this->service->updateField($id, $validated['field'], $validated['value']);
        return response()->json(['success' => true, 'field' => $validated['field'], 'value' => $validated['value']]);
    }

    /**
     * Persist a new display order (seq) after drag & drop reordering.
     * Receives product ids in their new order and stores seq = position.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'integer',
        ]);
        $this->service->reorderProducts($validated['ids']);
        return response()->json(['success' => true]);
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
