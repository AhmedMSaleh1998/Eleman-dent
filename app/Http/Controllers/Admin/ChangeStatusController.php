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
        return redirect()->back()->with(['success' => 'تم تعديل الحالة بنجاح ']);
    }
}
