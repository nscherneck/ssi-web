<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWorkOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('work_orders', function(Blueprint $table)
		{
			$table->foreign('site_id', 'FK_work_orders_sites')->references('id')->on('sites')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('created_by', 'FK_work_orders_users_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('assigned_to', 'FK_work_orders_users_3')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('completed_by', 'FK_work_orders_users_4')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('work_order_billing_status_id', 'FK_work_orders_work_order_billing_status')->references('id')->on('work_order_billing_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('status_id', 'FK_work_orders_work_order_status')->references('id')->on('work_order_status')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('type_id', 'FK_work_orders_work_order_types')->references('id')->on('work_order_types')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('work_orders', function(Blueprint $table)
		{
			$table->dropForeign('FK_work_orders_sites');
			$table->dropForeign('FK_work_orders_users_2');
			$table->dropForeign('FK_work_orders_users_3');
			$table->dropForeign('FK_work_orders_users_4');
			$table->dropForeign('FK_work_orders_work_order_billing_status');
			$table->dropForeign('FK_work_orders_work_order_status');
			$table->dropForeign('FK_work_orders_work_order_types');
		});
	}

}
