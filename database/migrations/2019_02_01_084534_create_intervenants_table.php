<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntervenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervenants', function (Blueprint $table) {
            $table->bigIncrements('id_interv');
            $table->string('nom',50);
            $table->string('prenom',50);
            $table->string('specif',100);
            $table->string('dom_interv',100);
            $table->string('module',900)->nullable();
            $table->string('tele',50)->nullable();
            $table->string('email',50)->nullable();
            $table->string('langs',50);
            $table->string('etat',50)->default("disponible");
            $table->binary('cv')->nullable();
            $table->string('nrc_c',50);

            $table->string('commentaire',5000)->nullable();

            $table->foreign('nrc_c')
            ->references('nrc_cab')
            ->on('cabinets')
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
        Schema::dropIfExists('intervenants');
    }
}
