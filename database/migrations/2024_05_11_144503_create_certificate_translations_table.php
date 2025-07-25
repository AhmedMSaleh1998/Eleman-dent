<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificate_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
			$table->integer('certificate_id')->unsigned();
			$table->string('locale')->nullable();
			$table->string('alt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificate_translations');
    }
};
