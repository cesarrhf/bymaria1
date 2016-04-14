<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presentaciones extends Model
{
  //no se por que va esto ahi, pero asi funciona
  public $timestamps = false;
  //DEFINO CUAL ES LA ID
   protected  $primaryKey = 'pres_id';
  // aqui van los campos que recibira para insertar o modificar en la tabla Productos en la BD.
      protected $fillable = [
        'pres_nombre',
        'pres_id_pro',
        'pres_foto'
      ];


      public function post4()
      {
          return $this->belongsToMany('App\Models\unidades_ventas','present_uni_ventas','univ_pres_id','univ_un_id');
      }
}
