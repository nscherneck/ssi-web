<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tests', function(Blueprint $table)
		{
			$table->foreign('added_by')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('system_id')->references('id')->on('systems')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('technician_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('test_result_id')->references('id')->on('test_results')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('test_type_id')->references('id')->on('test_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tests', function(Blueprint $table)
		{
			$table->dropForeign('tests_added_by_foreign');
			$table->dropForeign('tests_system_id_foreign');
			$table->dropForeign('tests_technician_id_foreign');
			$table->dropForeign('tests_test_result_id_foreign');
			$table->dropForeign('tests_test_type_id_foreign');
		});
	}

}
