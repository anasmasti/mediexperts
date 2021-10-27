<?php

namespace App;
use Illuminate\Support\Carbon;
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
      'id_form',
      'new_has_same_dates',
      'new_entreprise',
      'new_ref_plan',
      'new_theme_action',
      'new_nature_action',
      'new_hr_debut',
      'new_hr_fin',
      'new_pse_debut',
      'new_pse_fin',
      'new_date_realisation',
      'new_organisme_formations',
      'new_lieu_formations',
      'new_horaire_formations',
      'new_anulation',
      'new_type_action',
      'new_organisme',
      'new_lieu',
      'new_groupe',
      'new_pause',
      'new_date1',
      'new_date2',
      'new_date3',
      'new_date4',
      'new_date5',
      'new_date6',
      'new_date7',
      'new_date8',
      'new_date9',
      'new_date10',
      'new_date11',
      'new_date12',
      'new_date13',
      'new_date14',
      'new_date15',
      'new_date16',
      'new_date17',
      'new_date18',
      'new_date19',
      'new_date20',
      'new_date21',
      'new_date22',
      'new_date23',
      'new_date24',
      'new_date25',
      'new_date26',
      'new_date27',
      'new_date28',
      'new_date29',
      'new_date30',
    ];

    public function formation() {
      return $this->BelongsTo(Formation::class,PlanFormation::class);
    }

}
