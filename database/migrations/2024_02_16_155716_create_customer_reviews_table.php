<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomerReviewsTable extends Migration {

	public function up()
	{
		Schema::create('customer_reviews', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('review');
			$table->string('image')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('customer_reviews');
	}
}