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
      Schema::table('action_formations', function (Blueprint $table) {

        $table->boolean('date_realisation');
        $table->boolean('organisme_formations');
        $table->boolean('lieu_formations');
        $table->boolean('horaire_formations');
        $table->string('type_action');

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('action_formations', function (Blueprint $table) {
        //
        $table->dropColumn(['date_realisation', 'organisme_formations','lieu_formations','horaire_formations','type_action']);
    });
    }
}
