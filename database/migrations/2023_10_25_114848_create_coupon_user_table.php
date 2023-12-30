<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponUserTable extends Migration {

	public function up()
	{
		Schema::create('coupon_user', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('user_id')->unsigned();
			$table->integer('coupon_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('coupon_user');
	}
}