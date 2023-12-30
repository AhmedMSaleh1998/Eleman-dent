<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name_ar');
			$table->string('name_en');
			$table->string('image')->nullable();
			$table->tinyInteger('order');
			$table->tinyInteger('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}