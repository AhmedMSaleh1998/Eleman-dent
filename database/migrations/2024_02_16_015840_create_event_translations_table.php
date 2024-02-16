<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('event_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('event_id')->unsigned();
			$table->string('locale');
			$table->string('name')->nullable();
			$table->string('location')->nullable();
			$table->string('description')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('event_translations');
	}
}