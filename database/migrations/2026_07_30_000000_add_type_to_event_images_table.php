<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_images', function (Blueprint $table) {
            // نوع الملف المرفوع: image أو video — الصور في admin_assets/images/events
            // والفيديوهات في admin_assets/videos/events
            $table->string('type', 10)->default('image')->after('image');
        });

        // النص البديل مطلوب للصور بس، فالفيديو ممكن يتساب من غيره
        DB::statement('ALTER TABLE event_images MODIFY alt VARCHAR(255) NULL');
    }

    public function down()
    {
        Schema::table('event_images', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
