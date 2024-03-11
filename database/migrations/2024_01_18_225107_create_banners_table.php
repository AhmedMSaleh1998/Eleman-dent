<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannersTable extends Migration {

	public function up()
	{
		Schema::create('banners', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('image')->nullable();
			$table->string('url')->nullable();
			$table->tinyInteger('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('banners');
	}
}