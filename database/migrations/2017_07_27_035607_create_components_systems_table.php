<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComponentsSystemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('components_systems', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('system_id')->index('FK_systems-components_systems');
			$table->string('name')->nullable();
			$table->integer('component_id')->index('FK_systems-components_components');
			$table->smallInteger('quantity');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('components_systems');
	}

}
