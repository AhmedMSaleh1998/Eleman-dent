<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            // فيديو اختياري للحدث يظهر في كارت الأحداث بالموقع
            // الملف بيترفع في admin_assets/videos/events
            $table->string('video')->nullable()->after('image');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('video');
        });
    }
};
