<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficeUpdatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('office_updates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->integer('office')->unsigned();
			$table->foreign('office')->references('id')->on('offices');
			$table->string('name',100);
			$table->text('address');
			$table->integer('active')->unsigned();
			$table->integer('created_by')->unsigned();
			$table->foreign('created_by')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('office_updates');
	}

}
