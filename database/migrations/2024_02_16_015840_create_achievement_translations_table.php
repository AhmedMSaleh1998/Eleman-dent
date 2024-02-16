<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAchievementTranslationsTable extends Migration {

	public function up()
	{
		Schema::create('achievement_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('locale');
			$table->string('name');
			$table->integer('achievement_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('achievement_translations');
	}
}