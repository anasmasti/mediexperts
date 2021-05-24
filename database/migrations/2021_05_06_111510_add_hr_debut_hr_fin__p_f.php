<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHrDebutHrFinPF extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('plan_formations', function (Blueprint $table) {
          $table->string('hr_debut', 50);
          $table->string('hr_fin', 50);
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
        Schema::table('plan_formations', function (Blueprint $table) {

        $table->dropColumn(['hr_debut','hr_fin']);

        });
    }
}
