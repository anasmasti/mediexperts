<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandeRemboursementGiacs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_remboursement_giacs', function (Blueprint $table) {
            $table->bigIncrements('n_drb');
            $table->string('n_facture', 50)->nullable();
            $table->date('dt_facture')->nullable();
            $table->string('fact_cab_entr', 50)->default("non préparé");
            $table->string('relv_banc_cab', 50)->default("non préparé");
            $table->string('relv_banc_entrp', 50)->default("non préparé");
            $table->string('drb_ds', 50)->default("non préparé"); //+
            $table->string('drb_if', 50)->default("non préparé"); //+
            $table->string('frai_doss', 50)->default("non préparé");
            $table->date('dt_pay_entrp', 50)->nullable();
            $table->string('moyen_fin', 200)->default("non préparé");
            $table->string('ref_fin', 200)->default("non préparé");
            $table->string('avis_remise_fin', 200)->default("non préparé");
            $table->string('part_giac', 50)->nullable(); //+
            $table->string('montant_entrp_ttc', 50)->nullable();
            $table->string('montant_entrp_ht', 50)->nullable();

            $table->date('dt_depo_drb')->nullable();

            $table->date('dt_rb')->nullable();
            $table->string('moyen_rb', 200)->default("non préparé");
            $table->string('ref_rb', 200)->default("non préparé");
            $table->string('montant_rb')->nullable();

            $table->string('etat', 50)->default('initié');
            $table->string('commentaire', 5000)->nullable();

            $table->unsignedBigInteger('n_df');
            $table->foreign('n_df')
            ->references('n_df')
            ->on('demande_financements')
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
        Schema::dropIfExists('demande_remboursement_giacs');
    }
}
