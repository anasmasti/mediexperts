<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldActionFormation extends Model
{
  protected $primaryKey = 'n_form';

  protected $fillable =[
    'n_form',
    'old_id_dom',
    'old_id_thm',
    'old_n_action',
    'old_model5',
    'olf_model3',
    'old_f4',
    'old_fiche_eval',
    'old_support_form',
    'old_cv_inv',
    'old_avis_affich',
    'old_dt_debut',
    'old_dt_fin',
    'old_nb_jour',
    'old_nb_heure',
    'old_type_form',
    'old_organisme',
    'old_lieu',
    'old_nom_resp',
    'old_nb_grp',
    'old_nb_partcp_total',
    'old_nb_cadre',
    'old_nb_employe',
    'old_nb_ouvrier',
    'old_bdg_jour',
    'old_bdg_total',
    'old_bdg_letter',
    'old_etat',
    'old_id_inv',
    'old_id_plan',
    'old_commentaire'


  ];
  public function action_formation() {

    return $this->hasOne(PlanFormation::class, 'n_form','n_form');
}
}
