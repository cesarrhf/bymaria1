<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Regiones;
use App\Models\Productos;
use Mail;
use Session;
USE DB;
use Response;
use App\Http\Controllers\Controller;

class IndexController extends Controller{

  public function reciboPro($myplace){
  return \View::make('layouts.edit')->with('myplace', $myplace);
  }

  public function edit($id)
  {
    $myplace    =  'editarProducto';
    $producto   = \App\Models\Productos::find($id);
    $productos  = \App\Models\Productos::all();
    $present    = \App\Models\Presentaciones::where('pres_id_pro', '=', $producto->pro_id)->get();
    //dd($present);
    return view('layouts.edit')->with('myplace', $myplace)->with('producto', $producto)->with('productos', $productos)->with('present', $present);
  }


    public function index(){
      $listPro = Productos::all();
      return view('index')->with('listPro', $listPro);
    }

    public function contacto(){
     return view('contacto');
    }

    public function email(Request $request){
      // dd($request->all());
           $data  = $request->all();
            Mail::send('emails.contacto', $data, function($message) use ($request){
             $message->to('chermosilla@cecsoluciones.cl');
         //  $message->cc('chermosilla@cecsoluciones.cl');
             $message->from($request->contac_correo);
             $message->subject($request->contac_comentario);
          });
          DB::table('eventos')->insert(['evento_texto' => 'CORREO envio por contacto.Correo:'.$request->contac_correo.'. Comentario:'.$request->contac_comentario.'']);

          return response()->json([
            'mensaje' => 'Email enviado'
        ]);
    }

    public function donde(){
      $listPro   = Productos::all();
      $region    = DB::select('select distinct r.region_id, r.region_nombre
                                from productosComuna pc, comunas c, provincias p, regiones r, direcciones dir
                                where dir.dire_id = pc.prodComu_direc
                                and dir.dire_id_comu = c.comuna_id
                                and r.REGION_ID = p.PROVINCIA_REGION_ID
                                and c.COMUNA_PROVINCIA_ID = p.PROVINCIA_ID ');
     $clientes = DB::select('select * from clientes ORDER BY RAND() LIMIT 6');
     return view('donde')->with('listPro', $listPro)->with('region',$region)->with('clientes', $clientes);
    }

    public function getMarcadores(Request $request)
    {
      // dd($request->all());
     $querycont  = "";

        if ($request->tipoBusqueda==1) {
          foreach ($request->name as $indice=>$value) {
            if ($indice==count($request->name) ||$indice==0) {
              $querycont  .='"'.$value.'" ';
            }else{
              $querycont  .=',"'.$value.'" ';
            }
           }
          $producCommuna= DB::select('select  dir.dire_id, dir.dire_latitud, dir.dire_longitud, dir.dire_calle, dir.dire_num, cli.cli_razon
                                      from productosComuna pc, direcciones dir, clientes cli
                                      where dir.dire_id_comu = "'.$request->comu_id.'"
                                       and pc.prodComu_pro_id ='.$querycont.'
                                       and pc.prodComu_direc = dir.dire_id
                                       and cli.cli_id = dir.dire_id_cli
                                       and cli.cli_vende = 0');
        }else{
          $producCommuna= DB::select('select  dir.dire_id, dir.dire_latitud, dir.dire_longitud, dir.dire_calle, dir.dire_num, cli.cli_razon
                                      from productosComuna pc, direcciones dir, clientes cli
                                      where dir.dire_id_comu = "'.$request->comu_id.'"
                                       and pc.prodComu_direc = dir.dire_id
                                       and cli.cli_id = dir.dire_id_cli
                                       and cli.cli_vende = 1 ');

        }

      return json_encode($producCommuna);
    }



    public function showss(Request $request)
    {
      $comunas = DB::select('select distinct c.comuna_nombre, c.comuna_id
                              from productosComuna pc, comunas c, provincias p, regiones r, direcciones dir
                              where r.REGION_id="'.$request->id.'"
                              and dir.dire_id = pc.prodComu_direc
                              and dir.dire_id_comu = c.comuna_id
                              and r.REGION_ID = p.PROVINCIA_REGION_ID
                              and c.COMUNA_PROVINCIA_ID = p.PROVINCIA_ID ;');
      return json_encode($comunas);
    }



}
