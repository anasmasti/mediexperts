<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeRemboursementOfpptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_remboursement_ofppts', function (Blueprint $table) {
            $table->increments('n_drf');
            $table->string('refpdf',100);
            $table->integer('n_contrat');
            $table->string('model5');
            $table->string('model6');
            $table->string('accuse_model6');
            $table->string('fiche_eval_sythetique');
            $table->string('factures');
            $table->string('compris_cheques');
            $table->string('compris_remise');
            $table->string('relev_bq_societe');
            $table->string('relev_bq_cabinet');
            $table->date('date_depot_dmd_rembrs');
            $table->date('date_rembrs');
            $table->string('montant_rembrs',100);
            $table->string('etat',100);
            $table->unsignedBigInteger('id_plan'); //FK
            $table->unsignedBigInteger('nrc_entrp'); //FK
            $table->timestamps();

            $table->foreign('id_plan')
            ->references('id_plan')
            ->on('plans')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('nrc_entrp')
            ->references('nrc_entrp')
            ->on('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demande_remboursement_ofppts');
    }
}
