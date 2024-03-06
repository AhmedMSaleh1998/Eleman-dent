<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('location_one')->nullable();
			$table->string('location_two')->nullable();
			$table->string('email')->nullable();
			$table->string('phone_one')->nullable();
			$table->string('phone_two')->nullable();
			$table->string('src_one')->nullable();
			$table->string('src_two')->nullable();
			$table->string('whatsapp')->nullable();
			$table->string('facebook')->nullable();
			$table->string('instagram')->nullable();
			$table->string('youtube')->nullable();
			$table->string('twitter')->nullable();
			$table->integer('free_shipping')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}