<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{


  public function MenuPro()
  {
    

    $proMenu  = \App\Models\Productos::all();
    return $proMenu;
    //return 100;
  }
}
