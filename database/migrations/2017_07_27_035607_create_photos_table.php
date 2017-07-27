<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('caption');
			$table->integer('photoable_id')->unsigned();
			$table->string('photoable_type');
			$table->string('path')->nullable();
			$table->string('file_name')->nullable();
			$table->string('ext', 50)->nullable();
			$table->integer('added_by')->unsigned()->index('photos_added_by_foreign');
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
		Schema::drop('photos');
	}

}
