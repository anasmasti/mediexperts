<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    //
    protected $primaryKey = 'nrc_cab';

    protected $fillable = ['nrc_cab',
    'raisoci',
    'formjury',
    'dt_creat',
    'cap_soci',
    'dom_compet1',
    'dom_compet2',
    'dom_compet3',
    'materiel1',
    'materiel2',
    'materiel3',
    'id_fiscal',
    'ncnss',
    'npatente',
    'effectif',
    'nb_permanent',
    'nb_vacataire',
    'nb_formateur',
    'autre_emp',
    'effectif_etr',
    'nb_permanent_etr',
    'nb_vacataire_etr',
    'nb_formateur_etr',
    'autre_emp_etr',
    'org_etranger',
    'nom_gr1',
    'pren_gr1',
    'qualit_gr1',
    'nom_gr2',
    'pren_gr2',
    'qualit_gr2',
    'adress',
    'ville',
    'tele',
    'fax',
    'email',
    'website',
    'commentaire'];

    function intervenants() {
        return $this->hasMany(Intervenant::class);
    }
}
