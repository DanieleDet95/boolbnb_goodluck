<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHighlightSuiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('highlight_suite', function (Blueprint $table) {
          // // Date start & end
          $table->dateTime("start");
          $table->dateTime("end");

          // Foreign Key to suites
          $table->unsignedBigInteger('suite_id');
          $table->foreign('suite_id')
                ->references('id')
                ->on('suites')
                ->onDelete('cascade');

          // Foreign Key to highlights
          $table->unsignedBigInteger('highlight_id');
          $table->foreign('highlight_id')
                ->references('id')
                ->on('highlights')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('highlight_suite');
    }
}
