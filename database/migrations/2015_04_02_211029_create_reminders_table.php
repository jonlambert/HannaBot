<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reminders', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('method');
            $table->text('options');
            $table->text('body');
            $table->timestamp('time');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reminders');
	}

}
