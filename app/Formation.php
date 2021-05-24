<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Formation extends Model
{
    protected $primaryKey = 'id_form';

    protected $fillable =
    [
        'id_form',
        'n_facture',
        'dt_facture',
        'groupe',
        'nb_benif',
        // 'hr_debut',
        // 'hr_fin',
        'pse_debut',
        'pse_fin' ,
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
        'n_form',
        'commentaire'
    ];
    public function plan_formations()
    {
       return $this->belongsTo(PlanFormation::class);
    }
}
