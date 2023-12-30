<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAddressesTable extends Migration
{

	public function up()
	{
		Schema::create('addresses', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('district_id')->unsigned();
			$table->string('street');
			$table->string('building');
			$table->string('floor');
			$table->string('apartment');
			$table->string('phone');
			$table->string('longitude')->nullable();
			$table->string('Latitude')->nullable();
			$table->integer('user_id')->unsigned();
			$table->tinyInteger('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('addresses');
	}
}
