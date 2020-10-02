<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suites', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->string('title');
            $table->string("address");
            $table->integer("rooms");
            $table->integer("beds");
            $table->integer("baths");
            $table->integer("square_m");
            $table->decimal("latitude", 10, 6);
            $table->decimal("longitude", 10, 6);
            $table->float("price", 6, 2);
            $table->longText("description");
            $table->text("main_image");
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
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      Schema::dropIfExists('suites');
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');    
    }
}
