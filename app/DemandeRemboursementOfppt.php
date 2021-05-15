<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandeRemboursementOfppt extends Model
{
    //
    protected $primaryKey = 'n_drf';

    protected $fillable = [
      'n_drf',
      'nrc_entrp',
      'refpdf',
      'n_contrat',
      'model5',
      'model6',
      'accuse_model6',
      'fiche_eval_sythetique',
      'factures',
      'compris_cheques',
      'compris_remise',
      'relev_bq_societe',
      'relev_bq_cabinet',
      'date_depot_dmd_rembrs',
      'date_rembrs',
      'montant_rembrs',
      'etat',
      'id_plan',
    ];

    public function plans() {
      return $this->belongsTo('App\Models\Plan');
    }
}
