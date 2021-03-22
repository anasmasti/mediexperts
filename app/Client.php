<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    protected $primaryKey = 'nrc_entrp';

    protected $fillable =
    ['nrc_entrp',
    'raisoci',
    'rais_abrev',
    'formjury',
    'dt_creat',
    'obj_soci',
    'capt_soci',
    'sect_activ',
    'giac_rattach',
    'ice',
    'id_fiscal',
    'ncnss',
    'npatente',
    'sg_soci',
    'chif_aff_1',
    'chif_aff_2',
    'chif_aff_3',
    'chif_aff_4',
    'local_2',
    'ville',
    'effectif',
    'mass_salar',
    'tax_form_pers',
    'der_annee_csf',
    'nb_permanent',
    'nb_employe',
    'nb_occasional',
    'nb_ouvrier',
    'nb_cadre',
    'IF1_1',
    'DS1_2',
    'PF1_3',
    'IF2_1',
    'DS2_2',
    'PF2_3',
    'IF3_1',
    'DS3_2',
    'PF3_3',
    'annee_deja1',
    'annee_deja2',
    'annee_deja3',
    'tel_1',
    'tel_2',
    'fix_1',
    'fix_2',
    'fax_1',
    'fax_2',
    'website',
    'nom_dg1',
    'fonct_dg1',
    'gsm_dg1',
    'email_dg1',
    'nom_dg2',
    'fonct_dg2',
    'gsm_dg2',
    'email_dg2',
    'nom_resp',
    'fonct_resp',
    'gsm_resp',
    'email_resp',
    'rib',
    'agence_banc',
    'dt_relation',
    'tag1',
    'commentaire'];


    public function actionnaires() {
        return $this->hasMany(Actionnaire::class);
    }
    public function personnels() {
        return $this->hasMany(Personnel::class);
    }
}
