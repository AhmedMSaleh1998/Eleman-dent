<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('first_name', 255);
			$table->string('last_name', 255);
			$table->string('password');
			$table->string('phone');
			$table->string('email')->unique();
			$table->integer('city_id')->unsigned();
			$table->tinyInteger('status')->default(0);
			$table->softDeletes();
			$table->string('code')->nullable();
			$table->string('image')->nullable();
			$table->string('api_token')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}