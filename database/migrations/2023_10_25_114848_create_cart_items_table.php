<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartItemsTable extends Migration {

	public function up()
	{
		Schema::create('cart_items', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_size_id')->unsigned();
			$table->string('price');
			$table->integer('user_id')->unsigned();
			$table->string('quantity');
			$table->integer('order_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('cart_items');
	}
}