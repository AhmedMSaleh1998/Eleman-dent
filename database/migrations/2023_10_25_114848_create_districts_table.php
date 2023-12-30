<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDistrictsTable extends Migration {

	public function up()
	{
		Schema::create('districts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('name_ar');
			$table->string('name_en');
			$table->tinyInteger('status')->default('1');
			$table->integer('shipping_fees');
		});
	}

	public function down()
	{
		Schema::drop('districts');
	}
}