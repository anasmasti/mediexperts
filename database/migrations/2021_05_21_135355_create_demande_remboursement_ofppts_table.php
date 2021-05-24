
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandeRemboursementOfpptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demande_remboursement_ofppts', function (Blueprint $table) {
            $table->bigIncrements('n_drf');
            $table->string('refpdf',100)->nullable();
            $table->integer('n_contrat')->nullable();
            $table->string('model5',100)->nullable();
            $table->string('model6',100)->nullable();
            $table->string('accuse_model6',100)->nullable();
            $table->string('fiche_eval_sythetique',100)->nullable();
            $table->string('factures',100)->nullable();
            $table->string('compris_cheques',100)->nullable();
            $table->string('compris_remise',100)->nullable();
            $table->string('relev_bq_societe',100)->nullable();
            $table->string('relev_bq_cabinet',100)->nullable();
            $table->date('date_depot_dmd_rembrs')->nullable();
            $table->date('date_rembrs')->nullable();
            $table->string('montant_rembrs',100)->nullable();
            $table->string('etat',100)->nullable();
            $table->string('commenter' , 250)->nullable();
            $table->string('nrc_entrp',50); //FK
            $table->unsignedBigInteger('id_plan'); //FK
            $table->timestamps();

            $table->foreign('nrc_entrp')
            ->references('nrc_entrp')
            ->on('clients')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('id_plan')
            ->references('id_plan')
            ->on('plans')
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
        Schema::dropIfExists('demande_remboursement_ofppts');
    }
}