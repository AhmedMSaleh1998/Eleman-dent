<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image')->nullable();
			$table->date('date');
		});
	}

	public function down()
	{
		Schema::drop('events');
	}
}