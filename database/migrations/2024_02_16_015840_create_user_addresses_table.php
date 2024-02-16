<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAddressesTable extends Migration {

	public function up()
	{
		Schema::create('user_addresses', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('city_id')->unsigned();
			$table->string('street')->nullable();
			$table->string('building')->nullable();
			$table->string('floor')->nullable();
			$table->string('apartment')->nullable();
			$table->integer('user_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('user_addresses');
	}
}