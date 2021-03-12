<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id_plan');
            $table->string('n_contrat', 100)->nullable();
            $table->string('refpdf', 100);
            $table->string('annee', 20);

            $table->string('ct_PF', 100)->default("non préparé");
            $table->date('dt_recep_ct')->nullable();
            $table->date('dt_contrat_PFOPT')->nullable();
            $table->string('l_tierpay_PF', 100)->default("non préparé");
            $table->string('at_approb_ds', 100)->default("non préparé");
            $table->string('rpt_DS_PFOPT', 100)->default("non préparé");
            $table->string('rpt_IF_PFOPT', 100)->default("non préparé");
            $table->string('f2_PFOPT', 100)->default("non préparé");
            $table->string('model1_PFOPT', 100)->default("non préparé");
            $table->string('rib_PFOPT')->default("non préparé");
            $table->string('f3_PFOPT', 100)->default("non préparé");
            $table->string('at_qualif_PFOPT', 100)->default("non préparé");
            $table->string('eligib_cab_PFOPT', 100)->default("non préparé");
            $table->string('accuse_PFOPT', 100)->default("non préparé");
            $table->date('dt_accuse_PFOPT')->nullable();

            $table->string('etat', 50)->default("aucun");

            $table->string('nrc_e', 50);
            $table->string('commentaire', 5000)->nullable();

            $table->foreign('nrc_e')
            ->references('nrc_entrp')
            ->on('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');

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
        Schema::dropIfExists('plans');
    }
}
