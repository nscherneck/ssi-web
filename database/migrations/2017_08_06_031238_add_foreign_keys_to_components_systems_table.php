<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToComponentsSystemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('components_systems', function(Blueprint $table)
		{
			$table->foreign('component_id', 'FK_systems-components_components')->references('id')->on('components')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('system_id', 'FK_systems-components_systems')->references('id')->on('systems')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('components_systems', function(Blueprint $table)
		{
			$table->dropForeign('FK_systems-components_components');
			$table->dropForeign('FK_systems-components_systems');
		});
	}

}
