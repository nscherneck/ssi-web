<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('systems', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('site_id')->index('FK_systems_sites');
			$table->integer('system_type_id')->index('FK_systems_system_types');
			$table->string('name', 100)->nullable();
			$table->string('slug')->nullable();
			$table->date('install_date')->nullable();
			$table->boolean('ssi_install')->default(0);
			$table->boolean('ssi_test_acct')->default(0);
			$table->date('next_test_date')->nullable();
			$table->boolean('is_active')->default(1);
			$table->string('notes', 1000)->nullable();
			$table->integer('added_by')->nullable();
			$table->integer('updated_by')->nullable();
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
		Schema::drop('systems');
	}

}
