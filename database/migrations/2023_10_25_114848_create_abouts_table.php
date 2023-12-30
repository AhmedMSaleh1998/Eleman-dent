<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAboutsTable extends Migration {

	public function up()
	{
		Schema::create('abouts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('description')->nullable();
			$table->string('policy')->nullable();
			$table->string('title_one')->nullable();
			$table->string('value_one')->nullable();
			$table->string('title_two')->nullable();
			$table->string('value_two')->nullable();
			$table->string('title_three')->nullable();
			$table->string('value_three')->nullable();
			$table->string('title_four')->nullable();
			$table->string('value_four')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('abouts');
	}
}