<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitiesTable extends Migration {

	public function up()
	{
		Schema::create('cities', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->tinyInteger('status')->default('1');
			$table->integer('shipping_fess')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('cities');
	}
}