<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('payment_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('payment_id')->unsigned();
			$table->timestamps();
			$table->string('locale')->nullable();
			$table->string('name')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('payment_translations');
	}
}