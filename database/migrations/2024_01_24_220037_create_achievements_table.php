<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAchievementsTable extends Migration {

	public function up()
	{
		Schema::create('achievements', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->bigInteger('value');
		});
	}

	public function down()
	{
		Schema::drop('achievements');
	}
}