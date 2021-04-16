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
            $table->string('entreprise', 100);
            $table->string('ref_plan', 50);
            $table->string('theme_action', 250);
            $table->string('nature_action', 100);
            $table->string('old_hr_debut', 50);
            $table->string('old_hr_fin', 50);
            $table->string('old_pse_debut', 50)->nullable();
            $table->string('old_pse_fin', 50)->nullable();
            $table->boolean('date_realisation')->default(false);
            $table->boolean('organisme_formations')->default(false);
            $table->boolean('lieu_formations')->default(false);
            $table->boolean('horaire_formations')->default(false);
            $table->string('type_action')->default(null);
            $table->string('old_organisme', 250);
            $table->string('old_lieu', 250);
            $table->string('groupe', 50);
            $table->date('date1');
            $table->date('date2')->nullable();
            $table->date('date3')->nullable();
            $table->date('date4')->nullable();
            $table->date('date5')->nullable();
            $table->date('date6')->nullable();
            $table->date('date7')->nullable();
            $table->date('date8')->nullable();
            $table->date('date9')->nullable();
            $table->date('date10')->nullable();
            $table->date('date11')->nullable();
            $table->date('date12')->nullable();
            $table->date('date13')->nullable();
            $table->date('date14')->nullable();
            $table->date('date15')->nullable();
            $table->date('date16')->nullable();
            $table->date('date17')->nullable();
            $table->date('date18')->nullable();
            $table->date('date19')->nullable();
            $table->date('date20')->nullable();
            $table->date('date21')->nullable();
            $table->date('date22')->nullable();
            $table->date('date23')->nullable();
            $table->date('date24')->nullable();
            $table->date('date25')->nullable();
            $table->date('date26')->nullable();
            $table->date('date27')->nullable();
            $table->date('date28')->nullable();
            $table->date('date29')->nullable();
            $table->date('date30')->nullable();
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
