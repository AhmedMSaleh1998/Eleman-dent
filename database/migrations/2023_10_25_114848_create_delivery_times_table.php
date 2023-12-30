<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryTimesTable extends Migration {

	public function up()
	{
		Schema::create('delivery_times', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->time('from');
			$table->time('to');
			$table->tinyInteger('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('delivery_times');
	}
}