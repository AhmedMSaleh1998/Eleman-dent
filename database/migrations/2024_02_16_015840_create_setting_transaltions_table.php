<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingTransaltionsTable extends Migration {

	public function up()
	{
		Schema::create('setting_transaltions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('setting_id')->unsigned();
			$table->timestamps();
			$table->string('locale')->nullable();
			$table->string('logo_alt')->nullable();
			$table->string('about_us')->nullable();
			$table->string('address_one')->nullable();
			$table->string('address_two')->nullable();
			$table->string('keywords')->nullable();
			$table->string('privacy')->nullable();
			$table->string('terms');
		});
	}

	public function down()
	{
		Schema::drop('setting_transaltions');
	}
}