<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestnotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('testnotes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('test_id')->unsigned();
			$table->string('note');
			$table->integer('added_by')->unsigned()->index('testnotes_added_by_foreign');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('testnotes');
	}

}
