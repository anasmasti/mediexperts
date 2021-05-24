<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAvisModifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('plan_formations', function (Blueprint $table) {

        $table->boolean('date_realisation')->default(false);
        $table->boolean('organisme_formations')->default(false);
        $table->boolean('lieu_formations')->default(false);
        $table->boolean('horaire_formations')->default(false);
        $table->string('type_action')->default(null);

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
        $table->dropColumn(['date_realisation', 'organisme_formations','lieu_formations','horaire_formations','type_action']);
    });
    }
}
