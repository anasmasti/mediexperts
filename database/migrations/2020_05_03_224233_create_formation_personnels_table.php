<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormationPersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formation_personnels', function (Blueprint $table) {
            // $table->integer('id')->unique();
            $table->string('cin', 20);
            $table->unsignedBigInteger('id_form');

            $table->foreign('cin')
            ->references('cin')
            ->on('personnels')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_form')
            ->references('id_form')
            ->on('formations')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->primary(array('cin', 'id_form'));

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
        Schema::dropIfExists('formation_personnels');
    }
}
