<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandeRemboursementGiac extends Model
{
    protected $primaryKey = 'n_drb';

    protected $fillable =
    [
        'n_drb', //1
        'n_facture',
        'dt_facture',
        'fact_cab_entr', //1
        'dt_fact_cab_entr', //1
        'relv_banc_cab',
        'relv_banc_entrp',
        'drb_ds', //1+++
        'drb_if', //1+++
        'frai_doss',
        'moyen_fin',//3
        'avis_remise_fin', //3+*
        'ref_fin',//3
        'part_giac', //1
        'dt_pay_entrp', //1
        'montant_entrp_ht', //1
        'montant_entrp_ttc', //1

        'dt_depo_drb', //2

        //moyens paiement
        'moyen_rb',//3
        'ref_rb',//3
        'dt_rb', //3
        'montant_rb',//3
        'commentaire',
        'etat',
        'n_df'
    ];

    public function demande_financements() {
      return $this->belongsTo('App\Models\DemandeFinancement');
    }
}
