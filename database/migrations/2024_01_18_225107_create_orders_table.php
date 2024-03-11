<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('shipping')->nullable();
			$table->float('total')->nullable();
			$table->integer('payment_id')->unsigned()->nullable();
			$table->integer('address_id');
			$table->tinyInteger('status')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}