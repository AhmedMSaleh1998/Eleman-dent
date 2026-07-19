<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function __construct(CategoryService $service)
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
        $categories = $this->service->get();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = $this->service->parentOptions();
        // ييجي من زر "+ Sub" في القائمة عشان القسم الأب يكون متحدد جاهز
        $selectedParent = request('parent_id');
        return view('admin.category.create', compact('parents', 'selectedParent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try{
            $this->service->store($request);
            return redirect()->back()->with(['success' => 'تم إضافة القسم بنجاح']);
        }catch(\Exception $e){
            dd($e);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->service->show($id);
        $parents = $this->service->parentOptions($id);
        return view('admin.category.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {

        $this->service->update($request, $id);
        return redirect()->back()->with(['success' => 'تم تحديث القسم بنجاح']);
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
        return redirect(route('admin.category.index'))->with(['success' => 'تم حذف القسم بنجاح']);
    }

    /**
     * تحديث سريع لترتيب ظهور القسم في الصفحة الرئيسية من القائمة مباشرة
     */
    public function updateHomeOrder(Request $request, $id)
    {
        $validated = $request->validate([
            'home_order' => 'nullable|integer|min:0',
        ]);

        Category::where('id', $id)->update([
            'home_order' => $validated['home_order'] ?? null,
        ]);

        return redirect()->back()->with(['success' => 'تم تحديث ترتيب الظهور']);
    }
}
