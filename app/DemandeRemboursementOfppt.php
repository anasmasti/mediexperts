<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandeRemboursementOfppt extends Model
{
    protected $primaryKey = 'n_drb';

    protected $fillable =
    ['n_drb',

    //docs
    'model5',
    'f4',
    'fiche_eval_synth',
    'model6',
    'facture_PF',
    //moyens paiement
    'moyen_rb',
    'remise_avis',
    'releve',
    'montant_rb',
    //les justifs. paiement
    'justif_paiem_entrp',
    'justif_paiem_cab',
    'plan_form',

    'dt_envoi',
    'annee_csf',
    'dt_pay_entrp',
    'montant_entrp_ttc',
    'montant_entrp_ht',
    'dt_depo_drb',
    'dt_rb',
    'commentaire',
    'nrc_e'];

    
    public function cliens() {
      return $this->belongsTo(Client::class);
    }
}
