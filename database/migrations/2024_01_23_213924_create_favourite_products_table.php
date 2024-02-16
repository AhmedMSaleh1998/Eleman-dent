<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFavouriteProductsTable extends Migration {

	public function up()
	{
		Schema::create('favourite_products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
            $table->integer('product_id')->unsigned();
			$table->integer('user_id')->unsigned();

		});
	}

	public function down()
	{
		Schema::drop('favourite_products');
	}
}