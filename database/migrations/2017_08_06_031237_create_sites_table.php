<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sites', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('customer_id')->index('FK_sites_customers');
			$table->integer('branch_office_id')->unsigned()->nullable()->index('FK_sites_branch_offices');
			$table->string('name', 150)->nullable();
			$table->string('slug')->nullable();
			$table->string('address1', 150)->nullable();
			$table->string('address2', 150)->nullable();
			$table->string('address3', 150)->nullable();
			$table->string('city', 100)->nullable();
			$table->integer('state_id')->unsigned()->nullable()->index('FK_sites_states');
			$table->string('zip', 30)->nullable();
			$table->float('lat', 10, 6)->nullable();
			$table->float('lon', 10, 6)->nullable();
			$table->string('phone', 50)->nullable();
			$table->string('fax', 50)->nullable();
			$table->string('web', 250)->nullable();
			$table->string('notes', 1000)->nullable();
			$table->integer('added_by')->unsigned();
			$table->integer('updated_by')->unsigned()->nullable();
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
		Schema::drop('sites');
	}

}
