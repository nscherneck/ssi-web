<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('description')->nullable();
			$table->integer('documentable_id')->unsigned();
			$table->string('documentable_type');
			$table->integer('added_by')->unsigned()->index('documents_added_by_foreign');
			$table->integer('updated_by')->unsigned()->nullable()->index('documents_updated_by_foreign');
			$table->string('path');
			$table->string('file_name')->nullable();
			$table->string('ext', 50)->nullable();
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
		Schema::drop('documents');
	}

}
