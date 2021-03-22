<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AfterUpdateClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::unprepared('
        // CREATE TRIGGER after_update_clients
        // AFTER UPDATE ON clients
        // FOR EACH ROW
        // BEGIN
        //     IF old.raisoci <> new.raisoci THEN
        //         UPDATE plan_formations.lieu
        //         INNER JOIN plans on plans.nrc_e = clients.nrc_entrp
        //         INNER JOIN plan_formations on plan_formations.id_plan = plans.id_plan
        //         set plan_formations.lieu = NEW.raisoci
        //         WHERE clients.nrc_entrp = "11111";
        //     END IF;
        // END;');
        // DB::unprepared('CREATE TRIGGER after_update_clients
        // AFTER UPDATE ON clients
        // FOR EACH ROW
        //     BEGIN
        //     IF old.raisoci <> new.raisoci THEN
        //         UPDATE plan_formations.lieu
        //         INNER JOIN plans on plans.nrc_e = clients.nrc_entrp
        //         INNER JOIN plan_formations on plan_formations.id_plan = plans.id_plan
        //         set plan_formations.lieu = NEW.raisoci;
        //     END IF;
        //     IF old.nom_resp <> new.nom_resp THEN
        //         UPDATE plan_formations.nom_resp
        //         INNER JOIN plans on plans.nrc_e = clients.nrc_entrp
        //         INNER JOIN plan_formations on plan_formations.id_plan = plans.id_plan
        //         set plan_formations.nom_resp = NEW.nom_resp;
        //     END IF;
        // END;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `after_update_clients`');
    }
}
