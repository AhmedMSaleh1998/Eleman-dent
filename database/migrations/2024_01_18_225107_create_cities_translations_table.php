<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('cities_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('city_id')->unsigned();
			$table->timestamps();
			$table->string('name')->nullable();
			$table->string('locale')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('cities_translations');
	}
}