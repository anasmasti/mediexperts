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
            $table->string('new_entreprise', 100);
            $table->string('new_ref_plan', 50);
            $table->string('new_theme_action', 250);
            $table->string('new_nature_action', 100);
            $table->string('new_hr_debut', 50)->nullable();
            $table->string('new_hr_fin', 50)->nullable();
            $table->string('new_pse_debut', 50)->nullable();
            $table->string('new_pse_fin', 50)->nullable();
            $table->boolean('new_anulation')->default(false);
            $table->boolean('new_date_realisation')->default(false);
            $table->boolean('new_organisme_formations')->default(false);
            $table->boolean('new_lieu_formations')->default(false);
            $table->boolean('new_horaire_formations')->default(false);
            $table->string('new_type_action')->default(null);
            $table->string('new_organisme', 250)->nullable();
            $table->string('new_lieu', 250)->nullable();
            $table->boolean('new_has_same_dates')->default(false);
            $table->string('groupe', 250)->nullable();
            $table->date('new_date1')->nullable();
            $table->date('new_date2')->nullable();
            $table->date('new_date3')->nullable();
            $table->date('new_date4')->nullable();
            $table->date('new_date5')->nullable();
            $table->date('new_date6')->nullable();
            $table->date('new_date7')->nullable();
            $table->date('new_date8')->nullable();
            $table->date('new_date9')->nullable();
            $table->date('new_date10')->nullable();
            $table->date('new_date11')->nullable();
            $table->date('new_date12')->nullable();
            $table->date('new_date13')->nullable();
            $table->date('new_date14')->nullable();
            $table->date('new_date15')->nullable();
            $table->date('new_date16')->nullable();
            $table->date('new_date17')->nullable();
            $table->date('new_date18')->nullable();
            $table->date('new_date19')->nullable();
            $table->date('new_date20')->nullable();
            $table->date('new_date21')->nullable();
            $table->date('new_date22')->nullable();
            $table->date('new_date23')->nullable();
            $table->date('new_date24')->nullable();
            $table->date('new_date25')->nullable();
            $table->date('new_date26')->nullable();
            $table->date('new_date27')->nullable();
            $table->date('new_date28')->nullable();
            $table->date('new_date29')->nullable();
            $table->date('new_date30')->nullable();
            $table->unsignedBigInteger('n_form');
            $table->unsignedBigInteger('id_form');
            $table->boolean('new_pause')->default(false);


            // $table->foreign('n_form')
            // ->references('id_form')
            // ->on('plan_formations')
            // ->onUpdate('cascade')
            // ->onDelete('cascade');

            $table->foreign('n_form')
            ->references('n_form')
            ->on('formations')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_form')
            ->references('id_form')
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
