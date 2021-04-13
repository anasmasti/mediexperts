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
<<<<<<< HEAD:database/migrations/2021_03_22_083159_add__nombre__date.php
      Schema::table('plan_formations', function (Blueprint $table) {
        
        $table->dropColumn(['Nombre_Dates']);
    });
=======
        Schema::table('demande_financements', function (Blueprint $table) {
            //
            $table->dropColumn('n_contrat');
        });
>>>>>>> master:database/migrations/2021_03_12_100045_add_store__n__contrat.php
    }
}
