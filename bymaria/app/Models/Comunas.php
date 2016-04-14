<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comunas extends Model
{
  public $timestamps = false;
  //DEFINO CUAL ES LA ID
   protected  $primaryKey = 'COMUNA_ID';


  // // aqui van los campos que recibira para insertar o modificar en la tabla Productos en la BD.
  //     protected $fillable = [
  //       'comu_nombre',
  //       'comu_reg_id',
  //     ];
}
