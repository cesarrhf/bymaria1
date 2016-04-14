<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresentUniVenta extends Model
{
    public $timestamps = false;
    protected  $primaryKey = 'univ_id';
    protected $fillable = [
      'univ_pres_id',
      'univ_un_id'
      ];

  //definiendo relaciones!
 

}
