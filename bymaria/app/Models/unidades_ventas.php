<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class unidades_ventas extends Model
{
  public $timestamps = false;
  protected  $primaryKey = 'uni_id';
  // protected $fillable = [
  //   'uni_nombre',
  //   'uni_precio',
  //   'uni_publica',
  //   'uni_foto',
  //   'uni_descripcion'
  //   ];

    public function post2()
     {
       // OJO CON EL ORDEN DE LAS VARIABLES UQE SE LES DA AQUI, LA PRIMERA ES LA QUE ES ID DE LA TABLA PIVOTE
         return $this->belongsToMany('App\Models\Pedidos','Items','item_uni_id');
     }

     public function post4()
      {
        // OJO CON EL ORDEN DE LAS VARIABLES UQE SE LES DA AQUI, LA PRIMERA ES LA QUE ES ID DE LA TABLA PIVOTE
          return $this->belongsToMany('App\Models\Presentaciones','present_uni_ventas','univ_un_id','univ_pres_id')->withPivot('univ_id');
      }
}
