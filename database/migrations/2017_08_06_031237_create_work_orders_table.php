<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('work_orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('type_id')->unsigned()->index('FK_work_orders_work_order_types');
			$table->integer('site_id')->index('FK_work_orders_sites');
			$table->integer('created_by')->unsigned()->index('FK_work_orders_users_2');
			$table->integer('assigned_to')->unsigned()->index('FK_work_orders_users_3');
			$table->integer('completed_by')->unsigned()->nullable()->index('FK_work_orders_users_4');
			$table->integer('status_id')->unsigned()->index('FK_work_orders_work_order_status');
			$table->integer('work_order_billing_status_id')->unsigned()->index('FK_work_orders_work_order_billing_status');
			$table->string('work_order_number', 50)->nullable();
			$table->string('point_of_contact')->nullable();
			$table->string('customer_purchase_order')->nullable();
			$table->string('title')->nullable();
			$table->text('scope_of_work', 65535)->nullable();
			$table->text('resolution', 65535)->nullable();
			$table->text('charges', 65535)->nullable();
			$table->date('closed_date')->nullable();
			$table->dateTime('created_at_pst');
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
		Schema::drop('work_orders');
	}

}
