<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    //
    protected $primaryKey = "id_domain";

    protected $fillable =
    [
        'id_domain',
        'nom_domain',
        'region',
        'ville',
        'cout',
        'commentaire'
    ];
    
    
    public function themes() {
      return $this->hasMany(themes::class);
    }
}
