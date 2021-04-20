<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvisModificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avis_modifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('old_entreprise', 100);
            $table->string('old_ref_plan', 50);
            $table->string('old_theme_action', 250);
            $table->string('old_nature_action', 100);
            $table->string('old_hr_debut', 50);
            $table->string('old_hr_fin', 50);
            $table->string('old_pse_debut', 50)->nullable();
            $table->string('old_pse_fin', 50)->nullable();
            $table->boolean('old_anulation')->default(false);
            $table->boolean('old_date_realisation')->default(false);
            $table->boolean('old_organisme_formations')->default(false);
            $table->boolean('old_lieu_formations')->default(false);
            $table->boolean('old_horaire_formations')->default(false);
            $table->string('old_type_action')->default(null);
            $table->string('old_organisme', 250);
            $table->string('old_lieu', 250);
            $table->string('old_groupe', 50);
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
            $table->unsignedBigInteger('n_form');


            $table->foreign('n_form')
            ->references('id_form')
            ->on('plan_formations')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('n_form')
            ->references('n_form')
            ->on('formations')
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
        Schema::dropIfExists('avis_modifications');
    }
}
