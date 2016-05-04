<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserUpdatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_updates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('user')->unsigned();
			$table->foreign('user')->references('id')->on('users');
			$table->string('name',100);
			$table->string('email',100);
			$table->text('address');
			$table->string('phoneno',20);
			$table->string('designation',100);
			$table->integer('created_by')->unsigned();
			$table->foreign('created_by')->references('id')->on('users');
			$table->integer('active')->unsigned()->default(1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_updates');
	}

}
