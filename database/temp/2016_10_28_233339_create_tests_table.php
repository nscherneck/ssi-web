<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->date('test_date');
            $table->integer('added_by');
            $table->integer('technican');
            $table->integer('system_id');
            $table->integer('test_result_id');
            $table->integer('test_type_id');
            $table->foreign('system_id')->references('id')->on('systems')->onDelete('cascade');
            $table->foreign('test_result_id')->references('id')->on('test_results');
            $table->foreign('test_type_id')->references('id')->on('test_types');
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
        Schema::dropIfExists('tests');
    }
}
