<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Productos;
use App\Models\Presentaciones;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FrontController extends Controller

{

  public function __construct()
    {
        $this->middleware('auth');
    }
    
  public function admin(){

    //$producto   = \App\Models\Productos::find($id);
    $proMenu  = \App\Models\Productos::all();
  //  $present    = \App\Models\Presentaciones::where('pres_id_pro', '=', $producto->pro_id)->get();
    //dd($present);


  ///  return view('admin.inicio')->with('proMenu', $proMenu);
      return view('admin.inicio');
 }



}
