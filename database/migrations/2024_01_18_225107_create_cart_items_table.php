<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartItemsTable extends Migration {

	public function up()
	{
		Schema::create('cart_items', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id')->unsigned();
			$table->float('price');
			$table->integer('quantity');
			$table->integer('user_id')->unsigned();
			$table->integer('order_id')->unsigned()->default('null');
		});
	}

	public function down()
	{
		Schema::drop('cart_items');
	}
}