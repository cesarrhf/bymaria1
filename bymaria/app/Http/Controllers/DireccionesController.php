<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Direcciones;

class DireccionesController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
      $direc = new Direcciones;
       if($request->ajax()){

             $direc->dire_id_cli      = $request->id;
             $direc->dire_id_comu      = 13101;
             $direc->save();
             DB::table('log')->insert(['log_texto' => 'Guardo Direccion. Id Direccion:'.$direc->dire_id.'']);

           $insertedId = $direc->dire_id;
           return response()->json([
               "id"     => $insertedId,
               "mensaje"    => "creado"
           ]);
       }else {
         # code...
       }
    }


    public function show($id)
    {
       // $direcciones = DB::table('direcciones')->where('dire_id_cli', $id)->get();
      $direcciones = DB::select('select dir.dire_id, dir.dire_calle, dir.dire_num, dir.dire_dpto, c.COMUNA_NOMBRE, dir.dire_latitud , dir.dire_longitud
                                 from direcciones dir, comunas c
                                 where c.COMUNA_ID= dir.dire_id_comu
                                 and dir.dire_id_cli='.$id.' ');

    //  $view = \View::make('admin.pedidos.form.partials.formContDir')->with('diressas',$direcciones);
    //  $sections = $view->renderSections();
    //  return Response::json($sections['Diress']);

     return json_encode($direcciones);
    }


    public function edit($id)
    {

      //  $direcciones = DB::select('select dire')
      // $direcciones =db::table('direcciones')
      //                   ->where('dire_id',$id)
      //                   ->get();
      //dd($direcciones);
     // ANTIGUO !!! SE MODIFICO EL MIERCOLES 23
      $direcciones = DB::table('direcciones')
            ->join('comunas', 'direcciones.dire_id_comu', '=', 'comunas.COMUNA_ID')
            ->select('direcciones.dire_id','direcciones.dire_calle','direcciones.dire_num','direcciones.dire_dpto', 'comunas.COMUNA_NOMBRE' ,'direcciones.dire_latitud','direcciones.dire_longitud' )
            ->where('direcciones.dire_id', $id)
            ->first();
      //   if ($direcciones->count()) {
      //   echo "solo uno";
      // }else{
      //   echo "mas de uno":
      // }
          //  dd($direcciones);

      return json_encode($direcciones);
    }


    public function update(Request $request, $id)
    {
    //  dd($request->all());
      $direcciones = Direcciones::findOrFail($id);

      if ($request->posi==0) {
        $this->validate($request, [
        'texto'         => 'required'
        ]);
        $direcciones->dire_id_comu     = $request->texto;
      }if ($request->posi==1) {
        $this->validate($request, [
        'texto'         => 'required'
        ]);
          $direcciones->dire_calle    = $request->texto;
      }if ($request->posi==2) {
        $this->validate($request, [
        'texto'         => 'required'
        ]);
        $direcciones->dire_num     = $request->texto;
      } if ($request->posi==3) {
        $this->validate($request, [
        'texto'         => 'required'
        ]);
          $direcciones->dire_dpto  = $request->texto;
      }
      DB::table('log')->insert(['log_texto' => 'Edito Direccion. Id Direccion:'.$id.'. Texto: '.$request->texto.'']);

      $direcciones->save();
      return response()->json([
              "mensaje"         => "Direccion Editada"
        ]);
    }



    public function destroy($id)
    {
      $dire = Direcciones::find($id);
      $dire->delete();
      DB::table('log')->insert(['log_texto' => 'Elimino Direccion. Id Direccion:'.$id.'']);

      return response()->json([
              "mensaje"         => "Direccion Borrada"
        ]);
    }
}
