<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sites', function(Blueprint $table)
		{
			$table->foreign('branch_office_id', 'FK_sites_branch_offices')->references('id')->on('branch_offices')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('customer_id', 'FK_sites_customers')->references('id')->on('customers')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('state_id', 'FK_sites_states')->references('id')->on('states')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sites', function(Blueprint $table)
		{
			$table->dropForeign('FK_sites_branch_offices');
			$table->dropForeign('FK_sites_customers');
			$table->dropForeign('FK_sites_states');
		});
	}

}
