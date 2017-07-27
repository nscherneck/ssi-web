<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSystemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('systems', function(Blueprint $table)
		{
			$table->foreign('site_id', 'FK_systems_sites')->references('id')->on('sites')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('system_type_id', 'FK_systems_system_types')->references('id')->on('system_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('systems', function(Blueprint $table)
		{
			$table->dropForeign('FK_systems_sites');
			$table->dropForeign('FK_systems_system_types');
		});
	}

}
