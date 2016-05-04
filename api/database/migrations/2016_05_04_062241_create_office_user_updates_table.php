<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeUserUpdatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('office_user_updates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('created_by')->unsigned();
			$table->foreign('created_by')->references('id')->on('users');
			$table->integer('user')->unsigned();
			$table->foreign('user')->references('id')->on('users');
			$table->integer('office')->unsigned();
			$table->foreign('office')->references('id')->on('offices');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('office_user_updates');
	}

}
