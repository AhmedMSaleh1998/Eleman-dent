<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('setting_transaltions', function (Blueprint $table) {
            $table->string('working_hours')->nullable()->after('address_two');
        });

        // المواعيد اللي كانت مكتوبة ثابت في الفرونت
        $hours = [
            'en' => 'Sat – Thu: 9 AM – 6 PM',
            'ar' => 'السبت – الخميس: 9 ص – 6 م',
        ];

        foreach ($hours as $locale => $value) {
            DB::table('setting_transaltions')
                ->where('locale', $locale)
                ->whereNull('working_hours')
                ->update(['working_hours' => $value]);
        }
    }

    public function down()
    {
        Schema::table('setting_transaltions', function (Blueprint $table) {
            $table->dropColumn('working_hours');
        });
    }
};
