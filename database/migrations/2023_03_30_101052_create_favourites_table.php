<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouritesTable extends Migration {

	public function up()
	{
		Schema::create('favourites', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->string('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('favourites');
	}
}