<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_formations', function (Blueprint $table) {
            $table->bigIncrements('n_form');
            // $table->string('refpdf')->unique();
            $table->string('id_dom', 300); //domaine
            $table->string('id_thm', 300); //theme
            $table->string('n_action', 20); //numero d'action
            //docs
            $table->string('model5', 20)->default("non préparé");
            $table->string('model3', 20)->default("non préparé");
            $table->string('f4', 20)->default("non préparé");
            $table->string('fiche_eval', 20)->default("non préparé");
            $table->string('support_form', 20)->default("non préparé");
            $table->string('cv_inv', 20)->default("non préparé");
            $table->string('avis_affich', 20)->default("non préparé");
            //docs
            $table->date('dt_debut');
            $table->date('dt_fin');
            $table->integer('nb_jour');
            $table->string('type_form', 50);
            $table->string('organisme', 50);
            $table->string('lieu', 200);
            $table->string('nom_resp');
            $table->integer('nb_grp');
            $table->integer('nb_partcp_total');
            $table->integer('nb_cadre');
            $table->integer('nb_employe');
            $table->integer('nb_ouvrier');
            $table->double('bdg_jour');
            $table->double('bdg_total');
            $table->string('bdg_letter', 200)->nullable();
            $table->string('etat', 50)->default("aucun");
            $table->unsignedBigInteger('id_inv');
            $table->unsignedBigInteger('id_plan');
            $table->string('commentaire', 5000)->nullable();

            $table->foreign('id_inv')
            ->references('id_interv')
            ->on('intervenants')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_plan')
            ->references('id_plan')
            ->on('plans')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->timestamps();
        });
        // DB::statement("ALTER TABLE plan_formations ADD CONSTRAINT CHECK_DATE CHECK (dt_debut < dt_fin)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_formations');
    }
}
