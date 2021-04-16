<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DemandeFinancement extends Model
{
    protected $primaryKey = 'n_df';

    protected $fillable = [
    'n_df', //1
    'd_eligib_csf_entrp', //1+ ••••
    'type_miss', //1
    'annee_exerc', //1
    'gc_rattach', //1 +*

    'nb_interv', //2
    'dt_df', //2
    'jr_hm_demande', //2
    'bdg_demande', //2
    'prc_cote_part_demande',

    //docs
    'd_bulltin_adhes', //2
    // 'd_readhes', //2
    'd_df_DS', //2
    'd_df_IF', //2
    'd_cheque', //2
    'f_renseign_entrp', //2
    'f_etude_DS', //2
    'f_etude_IF', //2
    'l_tierpay_DS', //2
    'l_tierpay_IF', //2
    'd_honor', //2
    'doss_jury', //2+++ ••••
    'at_csf_doc', //2 +*
    'd_model6_n_1', //2+
    'd_model6_n_2', //2+
    'd_honor_act_form', //2

    //CSF
    'dem_csf', //2 +++
    'f1', //2+
    'd_statut', //2
    'd_rc', //2
    'at_domic_banc', //2
    'd_pouvoir', //2
    'at_csf_entrp', //2••••
    'dt_at_csf', //2 +*
    'bdg_pf', //2 +*

    //cabinet
    'at_compte', //2 +*
    'at_qual_cab', //2 +++
    'f_renseign_cab', //2
    'd_eligib_csf_cab', //2
    'd_fact_proforama_ds', //2
    'd_fact_proforama_if', //2
    'd_propal_DS', //2+
    'd_propal_IF', //2+
    'd_cv_consult_miss', //2

    //docs préparé == Déposé
    'dt_depos_df', //3+
    'accus_depos', //3 +*

    //Accordé
    'dt_accord', //4+++
    'ct_DS', //4
    'ct_IF', //4
    'dt_dep_contrat', //4+++++
    'dt_debut_miss', //4
    'dt_fin_miss', //4
    'jr_hm_valid', //4
    'cote_part_entrp', //4
    'prc_cote_part', //4+++
    'bdg_accord', //4
    //'n_contrat',

    'av_realis_DS', //5 ••••
    'av_realis_IF', //5 ••••
    'dt_envoi_av', //5 +++
    'planing_DS', //5+ ••••
    'planing_IF', //5+ ••••
    'rpt_realis', //5••••
    'dt_fin_realis', //5

    'at_approb', //6 ••••
    'dt_approb', //6
    'p_garde_DS', //6 ••••
    'p_garde_IF', //6 ••••
    'dem_approb_ds', //6+++ ••••
    'dem_approb_if', //6+++ ••••
    'f2', //6+++++ ••••
    'model_1', //6+++++ ••••
    'rpt_depose', //6 ••••
    'dt_depos_rpt', //6


    'n_facture',
    'dt_facture',

    'commentaire',
    'etat',
    'nrc_e'

    ];

    //81 elements

    public function clients() {
        return $this->belongsTo(Client::class);
    }
    public function demande_remboursement_giacs() {
        return $this->hasOne('App\Models\DemandeRemboursementGiac');
    }
}
