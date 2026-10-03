<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // بيانات تواصل كانت مكتوبة ثابت في الفرونت ومش متسجلة في الإعدادات
        DB::table('settings')
            ->where(function ($query) {
                $query->whereNull('phone_two')->orWhere('phone_two', '');
            })
            ->update(['phone_two' => '+201009876543']);

        // العناوين الإنجليزي متسجلة بحروف صغيرة فبتظهر كده في الموقع
        $addresses = [
            'address_one' => ['cairo' => 'Cairo'],
            'address_two' => ['zagazig' => 'Zagazig'],
        ];

        foreach ($addresses as $column => $map) {
            foreach ($map as $from => $to) {
                DB::table('setting_transaltions')
                    ->where('locale', 'en')
                    ->where($column, $from)
                    ->update([$column => $to]);
            }
        }
    }

    public function down()
    {
        // تعديل بيانات فقط — مفيش حاجة نرجعها
    }
};
