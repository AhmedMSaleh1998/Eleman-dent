<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('email')->nullable();
			$table->string('phone')->nullable();
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