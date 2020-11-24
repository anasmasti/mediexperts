<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    //
    protected $primaryKey = 'cin';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable =
    [
        'cin',
        'matricule',
        'nom',
        'prenom',
        'cnss',
        'dt_naiss',
        'dt_embch',
        'dt_demiss',
        'fonction',
        'csp',
        'etat',
        'nrc_e'
    ];

    public function clients() {
        return $this->belongsTo('Client', 'nrc_e', 'nrc_entrp');
    }
}
