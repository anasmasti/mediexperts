<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actionnaire extends Model
{
    //
    protected $primaryKey = 'id_act';

    protected $fillable = ['id_act',
    'nom',
    'prenom',
    'nb_acts',
    'percent',
    'commentaire',
    'nrc_e'];

    public function clients() {
        return $this->belongsTo(Client::class);
    }
}
