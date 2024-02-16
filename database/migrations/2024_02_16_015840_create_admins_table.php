<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends Migration {

	public function up()
	{
		Schema::create('admins', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name')->nullable();
			$table->string('email');
			$table->string('password');
		});
	}

	public function down()
	{
		Schema::drop('admins');
	}
}