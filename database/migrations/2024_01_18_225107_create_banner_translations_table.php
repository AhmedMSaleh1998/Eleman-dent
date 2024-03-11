<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannerTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('banner_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('banner_id')->unsigned();
			$table->string('locale')->nullable();
			$table->string('alt')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('banner_translations');
	}
}