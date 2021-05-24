<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDatePaiementEntrepriseColumnToPlanFormations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plan_formations', function (Blueprint $table) {
            $table->date('datePaiementEntreprise')->nullable()->after('commentaire');
            $table->string('ModeReferencePaiement', 200)->nullable()->after('commentaire');
            $table->integer('RemboursementOFPPT')->nullable()->after('commentaire');
            $table->integer('EcartRemboursement')->nullable()->after('commentaire');
            $table->string('JustifsEcart', 200)->nullable()->after('commentaire');
            $table->string('payerAllPF', 10)->nullable()->after('commentaire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plan_formations', function (Blueprint $table) {
            $table->dropColumn('datePaiementEntreprise');
            $table->dropColumn('ModeReferencePaiement');
            $table->dropColumn('RemboursementOFPPT');
            $table->dropColumn('EcartRemboursement');
            $table->dropColumn('JustifsEcart');
            $table->dropColumn('payerAllPF');
        });
    }
}