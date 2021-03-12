<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddApprob extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
          $table->dropColumn(['at_approb_PFOPT', 'rpt_DS_PFOPT']);



            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            //
            $table->string('at_approb_if')->default("non préparé")->nullable();
            $table->string('at_approb_ds')->default("non préparé")->nullable();
        });
    }
}
