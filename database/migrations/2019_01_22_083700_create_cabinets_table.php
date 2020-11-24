<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCabinetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabinets', function (Blueprint $table) {
            $table->string('nrc_cab', 50)->primary();
            $table->string('raisoci', 50)->unique();
            $table->string('formjury', 50);
            $table->double('cap_soci', 50);
            $table->date('dt_creat');
            $table->string('dom_compet1', 50);
            $table->string('dom_compet2', 50);
            $table->string('dom_compet3', 50);
            $table->string('materiel1', 50);
            $table->string('materiel2', 50);
            $table->string('materiel3', 50);
            $table->string('id_fiscal', 50)->unique();
            $table->string('ncnss', 50)->unique();
            $table->string('npatente', 50)->unique();
            $table->integer('effectif');
            $table->integer('autre_emp');
            $table->integer('nb_permanent');
            $table->integer('nb_vacataire');
            $table->integer('nb_formateur');
            $table->integer('nb_permanent_etr');
            $table->integer('nb_vacataire_etr');
            $table->integer('nb_formateur_etr');
            $table->integer('effectif_etr');
            $table->integer('autre_emp_etr');
            $table->string('org_etranger', 20)->default("non");
            $table->string('nom_gr1', 50);
            $table->string('pren_gr1', 50);
            $table->string('qualit_gr1', 50);
            $table->string('nom_gr2', 50);
            $table->string('pren_gr2', 50);
            $table->string('qualit_gr2', 50);
            $table->string('adress', 100);
            $table->string('ville', 50);
            $table->string('tele', 50)->unique();
            $table->string('fax', 50)->unique();
            $table->string('email', 50)->unique();
            $table->string('website', 50)->unique();
            $table->string('commentaire', 5000)->nullable();
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
        Schema::dropIfExists('cabinets');
    }
}
