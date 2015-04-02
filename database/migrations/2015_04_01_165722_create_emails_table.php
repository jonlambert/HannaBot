<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('email_messages', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('uid');
            $table->string('subject');
            $table->string('from');
            $table->timestamp('sent');
            $table->text('message');
            $table->text('html_message');
            $table->string('to');
            $table->integer('user_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email_messages');
	}

}
