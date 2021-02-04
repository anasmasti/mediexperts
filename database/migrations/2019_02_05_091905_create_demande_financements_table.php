<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandeFinancementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_financements', function (Blueprint $table) {
            $table->bigIncrements('n_df');

            $table->string('d_eligib_csf_entrp', 100)->default("non préparé");
            $table->string('type_miss', 100);
            $table->integer('annee_exerc');
            $table->string('gc_rattach', 200);
            $table->integer('nb_interv')->nullable();
            $table->date('dt_df')->nullable();
            $table->integer('jr_hm_demande')->nullable();
            $table->double('bdg_demande')->nullable();
            $table->string('prc_cote_part_demande', 10)->nullable();

            $table->string('d_bulltin_adhes', 100)->default("non préparé");
            $table->string('d_df_DS', 100)->default("non préparé");
            $table->string('d_df_IF', 100)->default("non préparé");
            $table->string('d_cheque', 100)->default("non préparé");
            $table->string('f_renseign_entrp', 100)->default("non préparé");
            $table->string('f_etude_DS', 100)->default("non préparé");
            $table->string('f_etude_IF', 100)->default("non préparé");
            $table->string('l_tierpay_DS', 100)->default("non préparé");
            $table->string('l_tierpay_IF', 100)->default("non préparé");
            $table->string('d_honor', 100)->default("non préparé");
            $table->string('d_model6_n_1', 100)->default("non préparé");
            $table->string('d_model6_n_2', 100)->default("non préparé");
            $table->string('d_honor_act_form', 100)->default("non préparé");
            $table->string('doss_jury', 100)->default("non préparé");
            $table->string('at_csf_doc', 100)->default("non préparé");
            $table->string('dem_csf', 100)->default("non préparé");
            $table->string('f1', 100)->default("non préparé");
            $table->string('d_statut', 100)->default("non préparé");
            $table->string('d_rc', 100)->default("non préparé");
            $table->string('at_domic_banc', 100)->default("non préparé");
            $table->string('d_pouvoir', 100)->default("non préparé");
            $table->string('at_csf_entrp', 100)->default("non préparé");
            $table->string('dt_at_csf', 100)->default("non préparé");
            $table->string('bdg_pf', 100)->default("non préparé");
            $table->string('at_qual_cab', 100)->default("non préparé");
            $table->string('at_compte', 100)->default("non préparé");
            $table->string('f_renseign_cab', 100)->default("non préparé");
            $table->string('d_eligib_csf_cab', 100)->default("non préparé");
            $table->string('d_fact_proforama_ds', 100)->default("non préparé");
            $table->string('d_fact_proforama_if', 100)->default("non préparé");
            $table->string('d_propal_DS', 100)->default("non préparé");
            $table->string('d_propal_IF', 100)->default("non préparé");
            $table->string('d_cv_consult_miss', 100)->default("non préparé");

            $table->date('dt_depos_df')->nullable();
            $table->string('accus_depos', 100)->default("non préparé");

            $table->date('dt_accord')->nullable();
            $table->string('ct_DS', 100)->default("non préparé");
            $table->string('ct_IF', 100)->default("non préparé");
            $table->date('dt_dep_contrat')->nullable();
            $table->date('dt_debut_miss')->nullable();
            $table->date('dt_fin_miss')->nullable();
            $table->integer('jr_hm_valid')->nullable();
            $table->double('cote_part_entrp')->nullable();
            $table->string('prc_cote_part', 100)->nullable();
            $table->double('bdg_accord')->nullable();
            $table->string('bdg_letter', 200)->nullable();
            $table->string('av_realis_DS', 100)->default("non préparé");
            $table->string('av_realis_IF', 100)->default("non préparé");
            $table->date('dt_envoi_av')->nullable();
            $table->string('planing_DS', 100)->default("non préparé");
            $table->string('planing_IF', 100)->default("non préparé");
            $table->string('rpt_realis', 100)->default("non préparé");
            $table->date('dt_fin_realis')->nullable();

            $table->string('at_approb', 100)->default("non préparé");
            $table->date('dt_approb')->nullable();
            $table->string('p_garde_DS', 100)->default("non préparé");
            $table->string('p_garde_IF', 100)->default("non préparé");
            $table->string('dem_approb_ds', 100)->default("non préparé");
            $table->string('dem_approb_if', 100)->default("non préparé");
            $table->string('f2', 100)->default("non préparé");
            $table->string('model_1', 100)->default("non préparé");
            $table->string('rpt_depose', 100)->default("non préparé");
            $table->date('dt_depos_rpt')->nullable();

            $table->string('commentaire', 10000)->nullable();
            $table->string('etat', 100);
            $table->string('nrc_e', 100);

            $table->string('n_facture', 50)->nullable();
            $table->date('dt_facture')->nullable();

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
        Schema::dropIfExists('demande_financements');
    }
}
