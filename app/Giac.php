<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Giac extends Model
{
    protected $primaryKey = 'code_giac';

    protected $fillable = ['code_giac',
    'libelle',
    'specif',
    'adlocal_1',
    'adlocal_2',
    'tele',
    'fax',
    'email',
    'website',
    'nom_dg',
    'tel_dg',
    'email_dg',
    'nom_resp',
    'tel_resp',
    'email_resp',
    'commentaire'
    ];
}
