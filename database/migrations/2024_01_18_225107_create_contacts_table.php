<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name')->nullable();
			$table->string('phone');
			$table->string('email')->nullable();
			$table->string('subject')->nullable();
			$table->string('message')->nullable();
			$table->tinyInteger('status')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}