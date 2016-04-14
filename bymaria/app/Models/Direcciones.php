<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direcciones extends Model
{
  protected  $primaryKey = 'dire_id';

  //no se por que va esto ahi, pero asi funciona
  public $timestamps = false;
}
