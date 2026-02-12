<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChangeStatusController extends Controller
{
    public function status($status, $db, $id)
    {
        $status == 0 ? $status = 1 : $status = 0;
        DB::table($db)->where('id', $id)->update(['status' => $status]);
        return redirect()->back()->with(['success' => 'Status changed successfully']);
    }

    public function topProduct($id)
    {
        $current = DB::table('products')->where('id', $id)->value('is_top_product');
        if ($current === null) {
            return redirect()->back()->with(['danger' => 'Product not found']);
        }

        $newValue = $current ? 0 : 1;
        DB::table('products')->where('id', $id)->update(['is_top_product' => $newValue]);

        $message = $newValue ? 'Product added to top products' : 'Product removed from top products';
        return redirect()->back()->with(['success' => $message]);
    }
}
