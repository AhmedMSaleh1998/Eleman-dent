<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterEventsTable extends Migration {

	public function up()
	{
		Schema::table('events', function(Blueprint $table) {
			$table->tinyInteger('status')->default('1');
		});
	}

	public function down()
	{
	}
}