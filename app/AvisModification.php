<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvisModification extends Model
{
    //

    protected $primaryKey = 'id';

    protected $fillable =
    [
      'id',
      'n_form',
      'entreprise',
      'ref_plan',
      'theme_action',
      'nature_action',
      'old_hr_debut',
      'old_hr_fin',
      'old_pse_debut',
      'old_pse_fin',
      'date_realisation',
      'organisme_formations',
      'lieu_formations',
      'horaire_formations',
      'type_action',
      'old_organisme',
      'old_lieu',
      'groupe',
      'date1',
      'date2',
      'date3',
      'date4',
      'date5',
      'date6',
      'date7',
      'date8',
      'date9',
      'date10',
      'date11',
      'date12',
      'date13',
      'date14',
      'date15',
      'date16',
      'date17',
      'date18',
      'date19',
      'date20',
      'date21',
      'date22',
      'date23',
      'date24',
      'date25',
      'date26',
      'date27',
      'date28',
      'date29',
      'date30',
    ];
}
