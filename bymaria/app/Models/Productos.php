<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
  //no se por que va esto ahi, pero asi funciona
  public $timestamps = false;
  //DEFINO CUAL ES LA ID
   protected  $primaryKey = 'pro_id';
  // aqui van los campos que recibira para insertar o modificar en la tabla Productos en la BD.
      protected $fillable = [
        'pro_nombre',
        'pro_descripcion',
        'pro_foto'
      ];


    

}
