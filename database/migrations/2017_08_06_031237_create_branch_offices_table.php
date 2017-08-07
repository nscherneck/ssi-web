<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBranchOfficesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('branch_offices', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 50);
			$table->string('address1');
			$table->string('address2')->nullable();
			$table->string('city');
			$table->integer('state_id')->unsigned()->index('FK_branch_offices_states');
			$table->string('zip', 20);
			$table->string('phone', 30)->nullable();
			$table->string('fax', 30)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('branch_offices');
	}

}
