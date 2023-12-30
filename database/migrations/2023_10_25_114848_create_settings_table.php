<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone_one')->nullable();
			$table->string('phone_two')->nullable();
			$table->string('email_one')->nullable();
			$table->string('email_two')->nullable();
			$table->string('address_ar')->nullable();
			$table->string('address_en')->nullable();
			$table->string('facebook')->nullable();
			$table->string('twitter')->nullable();
			$table->string('instagram')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}