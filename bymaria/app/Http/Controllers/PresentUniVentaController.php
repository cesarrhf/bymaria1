<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PresentUniVenta;
use App\Models\Presentaciones;
use App\Models\unidades_ventas;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class PresentUniVentaController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

    public function index()
    {

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

      $PresuniVta = new PresentUniVenta;
      if($request->ajax()){

            $PresuniVta->univ_pres_id      = $request->univ_pres_id;
            $PresuniVta->univ_un_id         = $request->univ_un_id;
            $PresuniVta->save();
            $insertedId = $PresuniVta->univ_id;
            DB::table('log')->insert(['log_texto' => 'Creo Presentacion Unidad. Id:'.$insertedId.'']);

          return response()->json([
              "univ_id"     => $insertedId,
              "mensaje"         => "creado"
          ]);
      }else {
        # code...
      }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


public function update(Request $request, $id)
{

    if($request->ajax()){
      $myqer  = unidades_ventas::find($request->id)->post4()->get()->toJson();
      $array = json_decode($myqer);
      if (empty($array)) {
       foreach($request->arraysPres as $i=>$j){
         if($j!==''){
          DB::table('log')->insert(['log_texto' => 'Actualizo Unidad vta. Id:'.$request->id.'']);
          unidades_ventas::findOrFail($request->id)->post4()->attach($j);
         }
       }
      }else{
        foreach($request->arraysPres as $i=>$j){
          if($j!==''){
          $band=  0;
          //array del insert
            foreach($array as $obj){
                if ($obj->pres_id==$j) {
                  $band=1;
                }
              }
            if ($band==0) {
                DB::table('log')->insert(['log_texto' => 'Actualizo Unidad vta. Id:'.$request->id.'']);
                unidades_ventas::findOrFail($request->id)->post4()->attach($j);
            }
        	}
        }
     }
  return response()->json([
          "mensaje"         => "Guardado Correcto"
    ]);
  }
}

    public function destroy(Request $request, $id)
    {
      DB::table('log')->insert(['log_texto' => 'Elimino Presentacion Unidad vta. Id:'.$request->idUni.'. id presentacion '.$request->idPres.'']);                    
      DB::table('present_uni_ventas')->where('univ_un_id', $request->idUni)->where('univ_pres_id', $request->idPres)->delete();
      return response()->json([
              "mensaje"         => "Eliminada Presentacion"
        ]);

    }
}
