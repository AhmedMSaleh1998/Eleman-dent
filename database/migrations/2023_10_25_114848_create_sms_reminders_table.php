<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSmsRemindersTable extends Migration
{

	public function up()
	{
		Schema::create('sms_reminders', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone');
			$table->string('name');
			$table->tinyInteger('status')->default('1');
			$table->tinyInteger('notify_order')->default('0');
			$table->tinyInteger('notify_payment')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('sms_reminders');
	}
}
