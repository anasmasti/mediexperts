<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MissionIntervenant extends Model
{
    // protected $primaryKey = ['id_interv','n_df'];

    protected $fillable = ['id', 'id_interv','n_df'];

    public $incrementing = false;
}
