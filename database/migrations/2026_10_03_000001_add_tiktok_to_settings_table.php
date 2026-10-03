<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('tiktok')->nullable()->after('youtube');
        });

        // لم يكن هناك حقل تيك توك، فرابط تيك توك اتحط في خانة يوتيوب
        // ننقله لمكانه الصحيح ونفضّي خانة يوتيوب
        DB::table('settings')
            ->where('youtube', 'like', '%tiktok.com%')
            ->update([
                'tiktok' => DB::raw('youtube'),
                'youtube' => null,
            ]);
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('tiktok');
        });
    }
};
