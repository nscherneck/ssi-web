<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tests', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('test_date');
			$table->integer('technician_id')->unsigned()->index('tests_technician_id_foreign');
			$table->integer('system_id')->index('tests_system_id_foreign');
			$table->integer('site_id')->nullable();
			$table->integer('customer_id')->nullable();
			$table->integer('test_result_id')->unsigned()->index('tests_test_result_id_foreign');
			$table->integer('test_type_id')->unsigned()->index('tests_test_type_id_foreign');
			$table->integer('added_by')->unsigned()->index('tests_added_by_foreign');
			$table->integer('updated_by')->unsigned()->nullable();
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
		Schema::drop('tests');
	}

}
