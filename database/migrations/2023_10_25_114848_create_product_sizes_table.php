<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductSizesTable extends Migration
{

	public function up()
	{
		Schema::create('product_sizes', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name_ar');
			$table->string('name_en');
			$table->integer('product_id')->unsigned();
			$table->double('price');
			$table->double('discount_price')->nullable();
			$table->tinyInteger('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('product_sizes');
	}
}
