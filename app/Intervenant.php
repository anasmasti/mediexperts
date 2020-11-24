<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervenant extends Model
{
    //
    protected $primaryKey = 'id_interv';

    protected $fillable = ['id_interv',
    'nom',
    'prenom',
    'specif',
    'dom_interv',
    'module',
    'tele',
    'email',
    'langs',
    'cv',
    'etat',
    'commentaire',
    'nrc_c'];

    function cabinet() {
        return $this->belongsTo(Cabinet::class);
    }
}
