<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('posts', function ($table) {
        $table->integer('fair_id')->unsigned();
        $table->foreign('fair_id')->references('id')->on('fairs');
      });
      Schema::table('lectures', function ($table) {
        $table->integer('fair_id')->unsigned();
        $table->foreign('fair_id')->references('id')->on('fairs');
      });
      Schema::table('partners', function ($table) {
        $table->integer('fair_id')->unsigned();
        $table->foreign('fair_id')->references('id')->on('fairs');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
