<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionnairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actionnaires', function (Blueprint $table) {
            $table->increments('id_act');
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->integer('nb_acts');
            $table->integer('percent');
            $table->integer('tag1')->default('1');
            $table->string('commentaire',5000)->nullable();;
            $table->string('nrc_e',50);

            $table->foreign('nrc_e')
            ->references('nrc_entrp')
            ->on('Clients')
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
        Schema::dropIfExists('actionnaires');
    }
}
