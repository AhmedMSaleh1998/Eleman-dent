<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // البانر الرئيسي في الإعدادات ما كانش بيظهر في أي مكان في الموقع
        // بانر الصفحة الرئيسية بيتدار من قسم البانرات
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('main_banner');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('main_banner')->nullable();
        });
    }
};
