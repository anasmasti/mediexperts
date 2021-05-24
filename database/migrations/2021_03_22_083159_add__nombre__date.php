<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNombreDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('plan_formations', function (Blueprint $table) {

        $table->integer('Nombre_Dates');


      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('plan_formations', function (Blueprint $table) {

        $table->dropColumn(['Nombre_Dates']);
    });
    }
}
