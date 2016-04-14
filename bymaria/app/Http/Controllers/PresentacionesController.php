<?php

namespace App\Http\Controllers;


//use  Request;
use App\Models\Presentaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PresentacionesController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

  public function update(Request $request, $id)
  {

  }


  public function destroy($id, Request $request){
     $present =  Presentaciones::findOrFail($id);
     $present->delete();
     DB::table('log')->insert(['log_texto' => 'Borro Presentacion. Id:'.$id.'']);

     $message =  $present->pres_nombre . ' Presentacion eliminada';
    if ($request->ajax()) {
      return response()->json([
        'id' =>$present->pres_id,
        'mensaje' => $message

      ]);
    }
    Session:flash('mensaje',$message);
    return redirect()->route('admin.productos.inicio');

  }

  public function upImgPres($id, Request $request){

     //dd($request->all());
    //  dd($id);
    $path = '/home/bymaria1/public_html/bymaria/imagenes/presentaciones/';
  //  dd($path);
    $present =  Presentaciones::findOrFail($id);

      if (isset($request->pres_foto)){
        //obtenemos el campo file definido en el formulario
        $file      = $request->file('pres_foto');
        $nombre    = $file->getClientOriginalName();
        //lo movemos al lugar que deseamos
        $file->move($path, $nombre);
        $present->pres_foto  = $nombre;
        $present->save();
        DB::table('log')->insert(['log_texto' => 'Actualizo foto de Presentacion. Id:'.$id.'']);

      }else{

      }
         if ($request->ajax()) {
           if (isset($nombre) ) {
             return response()->json([
               "mensaje" => "Imagen cambiada con exito",
               'nombre'  => $nombre
             ]);
           }

        }
  }

  public function store(Request $request)
  {

  //  dd($request->all());
      if($request->ajax()){
        //  Presentaciones::create($request->all());
        $present = new Presentaciones;
        $present->pres_foto="";
        $present->pres_nombre="";
        $present->pres_id_pro= $request->pres_id_pro;
        $present->save();
        DB::table('log')->insert(['log_texto' => 'Creo Presentacion. Id:'.$present->pres_id.'']);

        $insertedId = $present->pres_id;
          return response()->json([
            "mensaje" => "Nueva Presentacion agregada",
             "id" => $insertedId,
          ]);
      }
  }

  public function edit(Request $request){

    $present =  Presentaciones::findOrFail($request->id);

    if ($request->pos==0) {
      $present->pres_nombre = $request->texto;
    }if ($request->pos==1) {
      $present->pres_nombre = $request->foto;
   }
    $present->save();
    DB::table('log')->insert(['log_texto' => 'Actualizo Presentacion. Id:'.$id.'']);

    $message = 'Presentacion editada';
    if ($request->ajax()) {
      return response()->json([
        'id' =>$present->pres_id,
        'mensaje' => $message
      ]);
    }
    Session:flash('mensaje',$message);
    return redirect()->route('admin.productos.inicio');
  }

}
