<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despachos;
use App\Models\Pedidos;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class DespachosController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }


  public function UpdateZone(Request $request)
  {

      DB::table('zonas')
            ->where('zona_id', $request->id_hash)
            ->update(['zona_precio' => $request->precio,'zona_nombre' => $request->nombre]);

      DB::table('zonasCoordenadas')->where('zc_zona_id',$request->id_hash)->delete();

      foreach ($request->jsonObj3 as   $value) {
        DB::table('zonasCoordenadas')->insert(['zc_zona_id' => $request->id_hash ,'zc_coordenadas' => $value ]);
      }
      return response()->json([
        'mensaje' => 'Zona editado'
    ]);
  }

  public function BorraZone(Request $request)
  {
      DB::table('zonasCoordenadas')->where('zc_zona_id',$request->id_hash)->delete();
      DB::table('zonas')->where('zona_id',$request->id_hash)->delete();

      return response()->json([
        'mensaje' => 'Zona Borrada'
    ]);
  }


    public function guardarZona(Request $request)
    {
        // dd($request->all());
        $id = DB::table('zonas')->insertGetId(['zona_nombre' => $request->nombre ,'zona_precio' => $request->precio ]);
        foreach ($request->jsonObj_temp as   $value) {
          DB::table('zonasCoordenadas')->insert(['zc_zona_id' => $id ,'zc_coordenadas' => $value ]);
        }
        return response()->json([
          'id'      => $id,
          'mensaje' => 'Nueva Zona creada'
      ]);
    }

    public function crearZona()
    {
      $mis_zonas = DB::select('select * from zonas z, zonasCoordenadas zc
                                   where z.zona_id = zc.zc_zona_id ');
       return view('admin.despachos.create')->with('mis_zonas', $mis_zonas);
    }


    public function listarZonaDespa(Request $request)
    {
      $mis_zonas = DB::select('select * from zonas z, zonasCoordenadas zc
                                    where z.zona_id = zc.zc_zona_id order by  zona_id,zc_id asc;');
                                    return json_encode($mis_zonas);

     }


    public function store(Request $request)
    {
      if ($request->ajax()) {
          $despachos              = new Despachos();
          $despachos->item_ped_id = $request->item_ped_id;
          $despachos->item_uni_id = $request->item_uni_id;
          $despachos->save();
          $insertedId = $despachos->despa_id;
          DB::table('log')->insert(['log_texto' => 'Guardo en despacho contacto. Id Despacho:'.$despachos->despa_id.'. ID pedidos:'.$request->item_ped_id.'']);
          $pedidos =  Pedidos::findOrFail($insertedId);
          return response()->json([
            'id'      => $insertedId,
            'mensaje' => 'Insertado'
        ]);
      }
    }



}
