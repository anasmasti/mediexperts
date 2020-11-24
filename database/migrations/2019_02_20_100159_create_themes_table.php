<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->bigIncrements('id_theme');
            $table->string('nom_theme', 300);
            $table->string('objectif', 5000);
            $table->string('contenu', 5000);
            $table->string('commentaire', 5000)->nullable();
            $table->unsignedBigInteger('id_dom');
            $table->timestamps();


            $table->foreign('id_dom')
            ->references('id_domain')
            ->on('domaines')
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
        Schema::dropIfExists('themes');
    }
}
