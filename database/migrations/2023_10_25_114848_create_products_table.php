<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name_ar');
			$table->string('name_en');
			$table->integer('category_id')->unsigned();
			$table->text('description_ar')->nullable();
			$table->text('description_en')->nullable();
			$table->string('image')->nullable();
			$table->string('sku');
			$table->tinyInteger('status')->default('1');
			$table->tinyInteger('popular')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}