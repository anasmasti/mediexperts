<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasSameDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('plan_formations', function (Blueprint $table) {

        $table->boolean('Has_Same_Dates')->default(false);

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
        //
        $table->dropColumn(['Has_Same_Dates']);
    });
    }
}
