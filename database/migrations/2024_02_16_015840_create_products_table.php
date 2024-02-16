<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('category_id')->unsigned()->nullable();
			$table->integer('brand_id')->unsigned()->nullable();
			$table->float('price')->nullable();
			$table->string('image')->nullable();
			$table->integer('quantity')->nullable();
			$table->tinyInteger('status')->default('1');
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}