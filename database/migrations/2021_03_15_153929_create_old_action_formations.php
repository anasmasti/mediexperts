<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldActionFormations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_action_formations', function (Blueprint $table) {

          $table->unsignedBigInteger('old_n_form');
          // $table->string('old_refpdf')->unique();
          $table->string('old_id_dom', 300); //domaine
          $table->string('old_id_thm', 300); //theme
          $table->string('old_n_action', 20); //numero d'action
          //docs
          $table->string('old_model5', 20)->default("non préparé");
          $table->string('old_model3', 20)->default("non préparé");
          $table->string('old_f4', 20)->default("non préparé");
          $table->string('old_fiche_eval', 20)->default("non préparé");
          $table->string('old_support_form', 20)->default("non préparé");
          $table->string('old_cv_inv', 20)->default("non préparé");
          $table->string('old_avis_affich', 20)->default("non préparé");
          //docs
          $table->date('old_dt_debut');
          $table->date('old_dt_fin');
          $table->integer('old_nb_jour');
          $table->integer('old_nb_heure')->nullable();
          $table->string('old_type_form', 50);
          $table->string('old_organisme', 50);
          $table->string('old_lieu', 200);
          $table->string('old_nom_resp');
          $table->integer('old_nb_grp');
          $table->integer('old_nb_partcp_total');
          $table->integer('old_nb_cadre');
          $table->integer('old_nb_employe');
          $table->integer('old_nb_ouvrier');
          $table->double('old_bdg_jour');
          $table->double('old_bdg_total');
          $table->string('old_bdg_letter', 200)->nullable();
          $table->string('old_etat', 50)->default("aucun");
          $table->unsignedBigInteger('old_id_plan');
          $table->string('old_commentaire', 5000)->nullable();


          $table->foreign('old_n_form')
          ->references('n_form')
          ->on('plan_formations')
          ->onUpdate('cascade')
          ->onDelete('cascade');

          $table->primary('old_n_form');

          $table->foreign('old_id_plan')
          ->references('id_plan')
          ->on('plans')
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
        Schema::dropIfExists('old_action_formations');
    }
}
