<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeficienciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deficiencies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('test_id')->unsigned()->nullable();
			$table->text('description', 65535)->nullable();
			$table->integer('added_by')->unsigned()->nullable()->index('deficiencies_added_by_foreign');
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
		Schema::drop('deficiencies');
	}

}
