<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiverEmailAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('trigger_addresses', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id');
            $table->string('address');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trigger_addresses');
	}

}
