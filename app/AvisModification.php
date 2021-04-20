<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvisModification extends Model
{
    //

    protected $primaryKey = 'id';

    protected $fillable =
    [
      'id',
      'n_form',
      'old_entreprise',
      'old_ref_plan',
      'old_theme_action',
      'old_nature_action',
      'old_hr_debut',
      'old_hr_fin',
      'old_pse_debut',
      'old_pse_fin',
      'old_date_realisation',
      'old_organisme_formations',
      'old_lieu_formations',
      'old_horaire_formations',
      'old_anulation',
      'old_type_action',
      'old_organisme',
      'old_lieu',
      'old_groupe',
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
    ];

    public function formation() {
      return $this->BelongsTo(Formation::class,PlanFormation::class);
    }
}
