<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {
            $table->bigIncrements('id_form');
            $table->string('n_facture', 50)->nullable();
            $table->date('dt_facture')->nullable();
            $table->integer('groupe')->default(0);
            $table->string('nb_benif', 50);
            $table->string('hr_debut', 50);
            $table->string('hr_fin', 50);
            $table->string('pse_debut', 50);
            $table->string('pse_fin', 50);
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
            $table->string('commentaire', 5000)->nullable();;
            $table->timestamps();


            $table->foreign('n_form')
            ->references('n_form')
            ->on('plan_formations')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formations');
    }
}
