<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactos extends Model
{
  protected  $primaryKey = 'cont_id';

  //no se por que va esto ahi, pero asi funciona
  public $timestamps = false;
}
