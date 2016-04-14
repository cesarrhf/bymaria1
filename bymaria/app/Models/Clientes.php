<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{

  protected  $primaryKey = 'cli_id';

  //no se por que va esto ahi, pero asi funciona
  public $timestamps = false;
  // aqui van los campos que recibira para insertar o modificar en la tabla Productos en la BD.
      protected $fillable = [
        'cli_rut',
        'cli_razon',    
        'cli_clave',
        'cli_telefono',
        'cli_correo',

      ];
}
