<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToBranchOfficesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('branch_offices', function(Blueprint $table)
		{
			$table->foreign('state_id', 'FK_branch_offices_states')->references('id')->on('states')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('branch_offices', function(Blueprint $table)
		{
			$table->dropForeign('FK_branch_offices_states');
		});
	}

}
