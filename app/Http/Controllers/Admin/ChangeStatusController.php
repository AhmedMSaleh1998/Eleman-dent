<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChangeStatusController extends Controller
{
    public function status(Request $request, $status, $db, $id)
    {
        // لا يُسمح للأدمن بتغيير حالة طلب ألغاه العميل بنفسه
        if ($db === 'orders') {
            $cancelledByUser = DB::table('orders')->where('id', $id)->value('cancelled_by_user');
            if ($cancelledByUser) {
                $message = 'لا يمكن تعديل حالة طلب تم إلغاؤه من قبل العميل';
                if ($request->ajax()) {
                    return response()->json(['success' => false, 'message' => $message], 422);
                }
                return redirect()->back()->with(['danger' => $message]);
            }
        }

        // نقرأ الحالة الحالية من قاعدة البيانات ونعكسها (أدق من الاعتماد على القيمة القادمة في الرابط)
        $current = DB::table($db)->where('id', $id)->value('status');
        $newValue = $current ? 0 : 1;
        DB::table($db)->where('id', $id)->update(['status' => $newValue]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'status' => $newValue]);
        }

        return redirect()->back()->with(['success' => 'Status changed successfully']);
    }

    public function topProduct(Request $request, $id)
    {
        $current = DB::table('products')->where('id', $id)->value('is_top_product');
        if ($current === null) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Product not found'], 404);
            }
            return redirect()->back()->with(['danger' => 'Product not found']);
        }

        $newValue = $current ? 0 : 1;
        DB::table('products')->where('id', $id)->update(['is_top_product' => $newValue]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'is_top_product' => $newValue]);
        }

        $message = $newValue ? 'Product added to top products' : 'Product removed from top products';
        return redirect()->back()->with(['success' => $message]);
    }
}
