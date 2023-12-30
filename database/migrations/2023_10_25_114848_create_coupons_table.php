<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCouponsTable extends Migration {

	public function up()
	{
		Schema::create('coupons', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('code');
			$table->string('value');
			$table->tinyInteger('type')->default('0');
			$table->integer('uses')->nullable();
			$table->datetime('valid_from')->nullable();
			$table->datetime('valid_to')->nullable();
			$table->tinyInteger('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('coupons');
	}
}