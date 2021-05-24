<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OldFormation extends Model
{
  protected $primaryKey = 'id_form';

  protected $fillable = [

    'id_form',
    'old_n_facture',
    'old_dt_facture',
    'old_groupe',
    'old_nb_benif',
    'old_hr_debut',
    'old_hr_fin',
    'old_pse_debut',
    'old_pse_fin',
    'old_date1',
    'old_date2',
    'old_date3',
    'old_date4',
    'old_date5',
    'old_date6',
    'old_date7',
    'old_date8',
    'old_date9',
    'old_date10',
    'old_date11',
    'old_date12',
    'old_date13',
    'old_date14',
    'old_date15',
    'old_date16',
    'old_date17',
    'old_date18',
    'old_date19',
    'old_date20',
    'old_date21',
    'old_date22',
    'old_date23',
    'old_date24',
    'old_date25',
    'old_date26',
    'old_date27',
    'old_date28',
    'old_date29',
    'old_date30',
    'old_n_form',
    'old_id_inv',
    'commentaire',
    'created_at',
    'updated_at',
  ];

  public function formations() {

    return $this->hasMany(Formation::class, 'id_form','id_form');
}
}
