<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    //
    protected $primaryKey = 'id_theme';

    protected $fillable =
    [
        'id_theme',
        'nom_theme',
        'objectif',
        'contenu',
        'commentaire',
        'id_dom'
    ];

    
    public function domaines()
    {
       return $this->belongsTo(Domain::class);
    }
}
