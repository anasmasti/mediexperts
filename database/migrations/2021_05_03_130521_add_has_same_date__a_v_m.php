<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasSameDateAVM extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('avis_modifications', function (Blueprint $table) {

          $table->boolean('has_same_dates')->default(false);

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
        Schema::table('avis_modifications', function (Blueprint $table) {

          $table->dropColumn('has_same_dates');
      });
    }
}
