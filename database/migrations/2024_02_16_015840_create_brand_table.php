<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrandTable extends Migration {

	public function up()
	{
		Schema::create('brand', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->tinyInteger('status')->default('1');
			$table->string('image')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('brand');
	}
}