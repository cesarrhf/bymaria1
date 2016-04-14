<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
  public $timestamps = false;

  protected  $primaryKey = 'ped_id';

  public function post2()
   {
     // OJO CON EL ORDEN DE LAS VARIABLES UQE SE LES DA AQUI, LA PRIMERA ES LA QUE ES ID DE LA TABLA PIVOTE
       return $this->belongsToMany('App\Models\Pedidos','Items','item_ped_id');
   }
}
