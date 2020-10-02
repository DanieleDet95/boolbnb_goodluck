<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSuiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_suite', function (Blueprint $table) {
          $table->unsignedBigInteger('suite_id');
          $table->foreign('suite_id')
                ->references('id')
                ->on('suites')
                ->onDelete('cascade');

          $table->unsignedBigInteger('service_id');
          $table->foreign('service_id')
                ->references('id')
                ->on('services')
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
        Schema::dropIfExists('service_suite');
    }
}
