<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionFormation extends Model
{
    protected $primaryKey = 'n_form';

    protected $fillable =
    [
        'n_form',
        'n_action',

        //docs
        'model5', //fiche pres
        'model3',
        'f4',
        'fiche_eval',
        'support_form',
        'cv_inv',
        'avis_affich',

        'id_dom',
        'id_thm',
        'dt_debut',
        'dt_fin',
        'nb_jour',
        'nb_heure',
        'type_form',
        'organisme',
        'lieu',
        'nom_resp',
        'nb_grp',
        'nb_partcp_total',
        'nb_cadre',
        'nb_employe',
        'nb_ouvrier',
        'bdg_total',
        'bdg_jour',
        'id_inv',
        'nrc_e',
        'etat',
        'commentaire'
    ];


    public function formations()
    {
      return $this->hasMany(Formation::class);
    }
}
