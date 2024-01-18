<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('product_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->timestamps();
			$table->string('locale')->nullable();
			$table->string('name')->nullable();
			$table->string('title')->nullable();
			$table->string('alt')->nullable();
			$table->string('description')->nullable();
			$table->string('description_meta')->nullable();
			$table->string('keywords')->nullable();
			$table->string('keywords_meta')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('product_translations');
	}
}