<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->string('nrc_entrp',50)->primary();
            $table->string('raisoci',100)->unique();
            $table->string('rais_abrev',50)->unique();
            $table->string('ice',50)->unique();
            $table->string('formjury',50);
            $table->date('dt_creat');
            $table->string('obj_soci',100);
            $table->double('capt_soci',20,2);
            $table->string('sect_activ',100);
            $table->string('giac_rattach',50);
            $table->string('id_fiscal',50)->unique();
            // $table->string('id_entrp',50)->unique();
            $table->string('ncnss',50)->unique();
            $table->string('npatente',50)->unique();
            $table->double('chif_aff_1',20,2)->nullable();
            $table->double('chif_aff_2',20,2)->nullable();
            $table->double('chif_aff_3',20,2)->nullable();
            $table->double('chif_aff_4',20,2)->nullable();
            $table->integer('effectif');
            $table->double('mass_salar',20,2)->nullable();
            $table->double('tax_form_pers',20,2)->nullable();
            $table->integer('der_annee_csf')->nullable();
            $table->integer('nb_permanent');
            $table->integer('nb_employe');
            $table->integer('nb_occasional');
            $table->integer('nb_ouvrier');
            $table->integer('nb_cadre');
            $table->string('IF1_1')->default('non réalisée'); //MISSIONS 1
            $table->string('DS1_2')->default('non réalisée');
            $table->string('PF1_3')->default('non réalisée');
            $table->string('IF2_1')->default('non réalisée'); //MISSIONS 2
            $table->string('DS2_2')->default('non réalisée');
            $table->string('PF2_3')->default('non réalisée');
            $table->string('IF3_1')->default('non réalisée'); //MISSIONS 3
            $table->string('DS3_2')->default('non réalisée');
            $table->string('PF3_3')->default('non réalisée');
            $table->string('annee_deja1', 20)->nullable(); //DATES MISSIONS
            $table->string('annee_deja2', 20)->nullable();
            $table->string('annee_deja3', 20)->nullable();
            $table->string('tel_1',50)->nullable();
            $table->string('tel_2',50)->nullable();
            $table->string('fix_1',50)->nullable();
            $table->string('fix_2',50)->nullable();
            $table->string('fax_1',50)->nullable();
            $table->string('fax_2',50)->nullable();
            $table->string('website',100)->nullable();
            $table->string('sg_soci',200);
            $table->string('local_2',200);
            $table->string('ville',100);
            $table->string('nom_dg1',50);
            $table->string('fonct_dg1',50);
            $table->string('gsm_dg1',50)->nullable();
            $table->string('email_dg1',50)->nullable();
            $table->string('nom_dg2',50)->nullable();
            $table->string('fonct_dg2',50)->nullable();
            $table->string('gsm_dg2',50)->nullable();
            $table->string('email_dg2',50)->nullable();
            $table->string('nom_resp',50);
            $table->string('fonct_resp',50);
            $table->string('gsm_resp',50)->nullable();
            $table->string('email_resp',50)->nullable();
            $table->string('rib',50)->nullable();
            $table->string('agence_banc',50)->nullable();
            $table->double('estim_bgd_DS',20,2)->nullable();
            $table->double('estim_bdg_IF',20,2)->nullable();
            $table->double('estim_bdg_PF',20,2)->nullable();
            $table->date('dt_relation');
            // $table->integer('tag1')->default('1');
            $table->string('commentaire',5000)->nullable();;
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
        Schema::dropIfExists('clients');
    }
}
