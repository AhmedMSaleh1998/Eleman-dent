<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidersTable extends Migration {

	public function up()
	{
		Schema::create('sliders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name_ar');
			$table->string('image');
			$table->string('name_en');
			$table->string('description_ar');
			$table->string('description_en');
			$table->tinyInteger('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('sliders');
	}
}