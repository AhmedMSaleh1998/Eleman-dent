<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            // هل يظهر القسم في شريط "تصفح حسب الفئة" في الصفحة الرئيسية
            $table->boolean('show_in_home')->default(false)->after('status');
            // ترتيب الظهور في الصفحة الرئيسية (الأصغر أولاً)
            $table->integer('home_order')->nullable()->after('show_in_home');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn(['show_in_home', 'home_order']);
        });
    }
};
