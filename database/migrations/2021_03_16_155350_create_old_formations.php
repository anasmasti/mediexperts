<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldFormations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_formations', function (Blueprint $table) {
          $table->unsignedBigInteger('id_form');
          $table->string('old_n_facture', 50)->nullable();
          $table->date('old_dt_facture')->nullable();
          $table->integer('old_groupe')->default(0);
          $table->string('old_nb_benif', 50);
          $table->string('old_hr_debut', 50);
          $table->string('old_hr_fin', 50);
          $table->string('old_pse_debut', 50);
          $table->string('old_pse_fin', 50);
          $table->date('old_date1');
          $table->date('old_date2')->nullable();
          $table->date('old_date3')->nullable();
          $table->date('old_date4')->nullable();
          $table->date('old_date5')->nullable();
          $table->date('old_date6')->nullable();
          $table->date('old_date7')->nullable();
          $table->date('old_date8')->nullable();
          $table->date('old_date9')->nullable();
          $table->date('old_date10')->nullable();
          $table->date('old_date11')->nullable();
          $table->date('old_date12')->nullable();
          $table->date('old_date13')->nullable();
          $table->date('old_date14')->nullable();
          $table->date('old_date15')->nullable();
          $table->date('old_date16')->nullable();
          $table->date('old_date17')->nullable();
          $table->date('old_date18')->nullable();
          $table->date('old_date19')->nullable();
          $table->date('old_date20')->nullable();
          $table->date('old_date21')->nullable();
          $table->date('old_date22')->nullable();
          $table->date('old_date23')->nullable();
          $table->date('old_date24')->nullable();
          $table->date('old_date25')->nullable();
          $table->date('old_date26')->nullable();
          $table->date('old_date27')->nullable();
          $table->date('old_date28')->nullable();
          $table->date('old_date29')->nullable();
          $table->date('old_date30')->nullable();
          $table->unsignedBigInteger('old_n_form');
          $table->unsignedBigInteger('old_id_inv');
          $table->string('commentaire', 5000)->nullable();

          $table->foreign('id_form')
          ->references('id_form')
          ->on('formations')
          ->onUpdate('cascade')
          ->onDelete('cascade');

          $table->primary('id_form');


          $table->foreign('old_id_inv')
          ->references('id_interv')
          ->on('intervenants')
          ->onUpdate('cascade')
          ->onDelete('cascade');


          $table->foreign('old_n_form')
          ->references('old_n_form')
          ->on('old_action_formations')
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
        Schema::dropIfExists('old_formations');
    }
}

