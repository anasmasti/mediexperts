<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $primaryKey = 'id_plan';

    protected $fillable = [
        'id_plan',
        'refpdf',
        'nrc_e',
        'annee',
        'n_contrat',
        'type_contrat',
        
        //PF OFPPT
        'dt_recep_ct',
        'ct_PF',
        'dt_contrat_PFOPT',
        'l_tierpay_PF', //7 ••••
        'at_approb_ds', //7 ••••
        'at_approb_if', //7 ••••
        'rpt_IF_PFOPT', //7 ••••
        'f2_PFOPT', //7 ••••
        'model1_PFOPT', //7 ••••
        'rib_PFOPT', //7 ••••
        'f3_PFOPT', //7 ••••
        'at_qualif_PFOPT', //7 ••••
        'eligib_cab_PFOPT', //7 ••••
        'accuse_PFOPT', //7 ••••
        'dt_accuse_PFOPT', //7

        'etat',
        'commentaire'
    ];

    public function plan_formations()
    {
      return $this->hasMany(PlanFormation::class);
    }
}
