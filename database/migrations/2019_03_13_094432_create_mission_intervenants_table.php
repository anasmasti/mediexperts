<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionIntervenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_intervenants', function (Blueprint $table) {
            // $table->string('id')->unique();
            $table->unsignedBigInteger('id_interv');
            $table->unsignedBigInteger('n_df');

            $table->foreign('id_interv')
            ->references('id_interv')
            ->on('intervenants')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->foreign('n_df')
            ->references('n_df')
            ->on('demande_financements')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->primary(array('id_interv', 'n_df'));

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
        Schema::dropIfExists('mission_intervenants');
    }
}
