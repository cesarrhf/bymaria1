<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Clientes;
use DB;
use Response;


class ClientesController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

    public function index()
    {
        $cli = Clientes::all();
        return  view('admin.clientes.listar')->with('cli', $cli);
    }

    public function create()
    {
        return  view('admin.clientes.form.create');
    }

    public function store(Request $request)
    {
      //  dd($request->all());
        $this->validate($request, [
         'rut'          => 'required|numeric| Min:1',
         'Razon_social' => 'required',
        'Telefono'      => 'required|numeric',
        'Correo'        => 'required|email',

    ]);
       if ($request->cli_vende==true) {
         $valortemp = 1;
       }else{
         $valortemp = 0;
       }
        if ($request->ajax()) {
          if ($request->Imagen_Cliente!='undefined'){
            $path = '/home/bymaria1/public_html/bymaria/imagenes/Logos Clientes';
            $file      = $request->file('Imagen_Cliente');
            $nombre    = $file->getClientOriginalName();
            $file->move($path, $nombre);
           }else{
             $nombre ='';
           }

            $cli = new Clientes();
            $cli->cli_rut      = $request->rut;
            $cli->cli_razon    = $request->Razon_social;
            $cli->cli_clave    = $request->Clave;
            $cli->cli_telefono = $request->Telefono;
            $cli->cli_correo   = $request->Correo;
            $cli->cli_http     = $request->cli_http;
            $cli->cli_foto     = $nombre;
            $cli->cli_vende    = $valortemp;
            $cli->save();
            $insertedId        = $cli->cli_id;

            DB::table('log')->insert(['log_texto' => 'nuevo usuario. ID:'.$insertedId.' username:'.$cli->cli_rut.'']);

            return response()->json([
              'mensaje' => 'Cliente creado',
              'id'      => $insertedId,
          ]);
        }
    }


    public function show($id)
    {
        return  view('admin.clientes.form.partials.createCli');
    }


    public function coordDire(Request $request)
    {
        // dd($request->all());
        DB::table('log')->insert(['log_texto' => 'Actualizo coordenadas de direccion. ID:'.$request->id.'']);

         DB::table('direcciones')
                    ->where('dire_id', $request->id)
                    ->update(['dire_latitud' => $request->latitud,'dire_longitud'=> $request->longitud]);

        return response()->json([
                'mensaje' => 'coordenada guardado',
          ]);
    }


    public function updatee(Request $request)
    {
    // dd($request->all());
      $this->validate($request, [
      'rut'            => 'required| Min:1',
      'Razon_social'   => 'required',
      'Telefono'       => 'required|numeric',
      'Correo'         => 'required|email',

    ]);
    $cli = Clientes::findOrFail($request->id);

     if ($request->Imagen_Cliente!='undefined') {

      $path      = '/home/bymaria1/public_html/bymaria/imagenes/Logos Clientes';
      $file      = $request->file('Imagen_Cliente');
      $nombre    = $file->getClientOriginalName();
      $file->move($path, $nombre);
      $cli->cli_foto        = $nombre;

    }
      if ($request->cli_vende=='true') {
        $valortemp = 1;
      }else{
        $valortemp = 0;
      }
      $cli->cli_rut      =  $request->rut;
      $cli->cli_razon    =  $request->Razon_social;
      $cli->cli_clave    =  $request->Clave;
      $cli->cli_telefono =  $request->Telefono;
      $cli->cli_correo   =  $request->Correo;
      $cli->cli_vende    = $valortemp;
      $cli->save();

      DB::table('log')->insert(['log_texto' => 'Actualizo Cliente. ID:'.$request->id.'']);


        $cli = Clientes::all();
        $view = \View::make('admin.clientes.listar')->with('cli', $cli);
        $sections = $view->renderSections();
        return Response::json($sections['test']);
    }

    public function destroy($id)
    {
        //    dd($id);
        DB::table('log')->insert(['log_texto' => 'Elimino contactos de Cliente. ID:'.$id.'']);
        DB::table('contactos')->where('cont_id_cliente', '=', $id)->delete();
        DB::table('log')->insert(['log_texto' => 'Elimino direcciones de Cliente. ID:'.$id.'']);
        DB::table('direcciones')->where('dire_id_cli', '=', $id)->delete();
        $cli = Clientes::find($id);
        DB::table('log')->insert(['log_texto' => 'Elimino Cliente. ID:'.$id.'']);
        $cli->delete();

        return response()->json([
                'mensaje' => 'Borrado',
          ]);
    }
}
