<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComponentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('components', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('manufacturer_id')->index('FK_components_manufacturers');
			$table->string('model', 150);
			$table->boolean('discontinued')->default(0);
			$table->integer('component_category_id')->index('FK_components_component_category');
			$table->timestamps();
			$table->text('description', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('components');
	}

}
