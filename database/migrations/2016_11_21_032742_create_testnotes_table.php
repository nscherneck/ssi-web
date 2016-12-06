<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestnotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testnotes', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('test_id')->unsigned();
          $table->string('note', 255);
          $table->integer('added_by')->unsigned();
          $table->timestamps();
          $table->foreign('added_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testnotes');
    }
}
