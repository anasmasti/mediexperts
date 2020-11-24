<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->string('cin', 20)->primary();
            $table->integer('matricule')->unique();
            $table->string('nom', 50);
            $table->string('prenom', 50);
            $table->string('cnss', 20)->unique();
            $table->date('dt_naiss')->nullable();
            $table->date('dt_embch')->nullable();
            $table->date('dt_demiss')->nullable();
            $table->string('fonction', 50);
            $table->string('csp', 20);
            $table->string('etat', 50)->nullable();
            $table->string('nrc_e', 50);

            $table->foreign('nrc_e')
            ->references('nrc_entrp')
            ->on('clients')
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
        Schema::dropIfExists('personnels');
    }
}
