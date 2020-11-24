<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormationPersonnel extends Model
{
  //
  protected $fillable = ['cin', 'id_form'];

  public $incrementing = false;
}
