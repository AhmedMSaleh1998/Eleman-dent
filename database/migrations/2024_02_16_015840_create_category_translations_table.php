<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoryTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('category_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id')->unsigned();
			$table->timestamps();
			$table->string('locale')->nullable();
			$table->string('name')->nullable();
			$table->string('title')->nullable();
			$table->string('alt')->nullable();
			$table->string('description')->nullable();
			$table->string('description_meta', 2500)->nullable();
			$table->string('keywords')->nullable();
			$table->string('keywords_meta')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('category_translations');
	}
}