<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('n_drb');
            //docs
            $table->string('justif_paiem_entrp',20)->default("non préparé");
            $table->string('justif_paiem_cab',20)->default("non préparé");
            $table->string('model5',20)->default("non préparé");
            $table->string('f4',20)->default("non préparé");
            $table->string('fiche_eval_synth',20)->default("non préparé");
            $table->string('model6',20)->default("non préparé");
            $table->string('facture_PF',20)->default("non préparé");
            $table->string('plan_form',20)->default("non préparé");

            $table->string('moyen_fin',20)->default("non préparé");
            $table->string('remise_avis_fin',20)->default("non préparé");
            $table->string('releve_fin',20)->default("non préparé");

            $table->string('moyen_rb',20)->default("non préparé");
            $table->string('remise_avis',20)->default("non préparé");
            $table->string('releve',20)->default("non préparé");


            $table->date('dt_envoi',20)->nullable();
            $table->string('annee_csf',10)->nullable();
            $table->date('dt_pay_entrp')->nullable();
            $table->string('montant_entrp_ttc')->nullable();
            $table->string('montant_entrp_ht')->nullable();
            $table->date('dt_depo_drb')->nullable();
            $table->date('dt_rb')->nullable();
            $table->string('montant_rb',20)->nullable();
            $table->string('commentaire', 5000)->nullable();
            $table->string('nrc_e', 50);
            $table->foreign('nrc_e')
            ->references('nrc_entrp')
            ->on('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->timestamps();
        });
        // DB::statement("ALTER TABLE demande_remboursement_ofppts ADD CONSTRAINT CHECK_DATE CHECK (dt_depo_drb < dt_rb)");
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
