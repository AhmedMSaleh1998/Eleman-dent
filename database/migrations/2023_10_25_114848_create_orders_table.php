<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{

	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('card_description')->nullable();
			$table->double('shipping')->default('0');
			$table->decimal('total');
			$table->integer('payment_id')->unsigned();
			$table->integer('address_id')->unsigned();
			$table->integer('coupon_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned();
			$table->integer('deliver_time_id')->unsigned()->nullable();
			$table->tinyInteger('deliver_type')->default('0');
			$table->date('deliver_date')->nullable();
			$table->string('coupon_value')->nullable();
			$table->tinyInteger('status')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
