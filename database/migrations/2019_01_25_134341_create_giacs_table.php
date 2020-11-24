<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGiacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('giacs', function (Blueprint $table) {
            $table->increments('code_giac');
            $table->string('libelle', 50)->unique();
            $table->string('specif', 50);
            $table->string('adlocal_1', 100);
            $table->string('adlocal_2', 100)->nullable();
            $table->string('tele', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('email', 50)->unique();
            $table->string('website', 50)->unique();
            $table->string('nom_dg', 50)->nullable();
            $table->string('tel_dg', 50)->nullable();
            $table->string('email_dg', 50)->nullable();
            $table->string('nom_resp', 50)->nullable();
            $table->string('tel_resp', 50)->nullable();
            $table->string('email_resp', 50)->nullable();
            $table->string('commentaire', 5000)->nullable();
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
        Schema::dropIfExists('giacs');
    }
}
