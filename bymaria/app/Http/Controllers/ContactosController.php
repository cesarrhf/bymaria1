<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contactos;
use App\Models\Clientes;
use App\Models\Comunas;
use DB;
use Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactosController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

    public function index()   {  }
    public function create()  {  }

    public function store(Request $request)
    {
     //dd($request->all());
      $contac = new Contactos;

     /*
      $this->validate($request, [
         'uni_nombre'      => 'required|min:5',
         'uni_descripcion' => 'required',
         'uni_precio'    => 'required',
         'uni_foto'    => 'required|image|min:1'
       ]);
 */
       if($request->ajax()){

             $contac->cont_id_cliente  = $request->id;
             $contac->cont_nombre      = "";
             $contac->cont_apellido    = "";
             $contac->cont_telefono    = "";
             $contac->cont_email       = "";
             $contac->save();
             $insertedId = $contac->cont_id;
             DB::table('log')->insert(['log_texto' => 'Creo contacto. id Cliente:'.$request->id.' id Contacto:'.$insertedId.'']);

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

      $clienteRequest =  Clientes::find($id);

      $contactosCli = DB::select("select c.cont_id,cli.cli_razon,cli.cli_id ,c.cont_nombre, c.cont_apellido, c.cont_telefono, c.cont_email
                                  from clientes cli, contactos c
                                  where cli.cli_id = c.cont_id_cliente
                                  and cli.cli_id=".$id."" );

      $direcCli = DB::select("select d.dire_id,c.COMUNA_NOMBRE,d.dire_calle,d.dire_num,d.dire_dpto,d.dire_id_comu
                                  from clientes cli, direcciones d, comunas c
                                  where cli.cli_id = d.dire_id_cli
                                  and d.dire_id_comu = c.COMUNA_ID
                                  and cli.cli_id=".$id."" );

      $comuna = Comunas::all();

      return view('admin.clientes.form.modalEditContac')->with('contactosCli', $contactosCli)
      ->with('direcCli',$direcCli)
      ->with('clienteRequest',$clienteRequest)
      ->with('comuna',$comuna);

    }

    public function edit($id)
    {

      $contactosCli = DB::select("select c.cont_id,c.cont_nombre
                                  from clientes cli, contactos c
                                  where cli.cli_id = c.cont_id_cliente
                                  and cli.cli_id=".$id."" );

      $view = \View::make('admin.pedidos.form.partials.formCli')->with('contactosCli',$contactosCli);
      $sections = $view->renderSections();
      return Response::json($sections['contacCli']);
    }


    public function update(Request $request, $id)
    {
    //  dd($request->all());
   //dd($id);
      $contact = Contactos::findOrFail($id);

      if ($request->posi==0) {
        $this->validate($request, [
        'texto'         => 'required'
        ]);
        $contact->cont_nombre       = $request->texto;
      }if ($request->posi==1) {
        $this->validate($request, [
        'texto'         => 'required'
        ]);
          $contact->cont_apellido    = $request->texto;
      }if ($request->posi==2) {
        $this->validate($request, [
        'texto'         => 'required'
        ]);
        $contact->cont_telefono     = $request->texto;
      } if ($request->posi==3) {
        $this->validate($request, [
        'texto'         => 'required'
        ]);
          $contact->cont_email  = $request->texto;
      }
      $contact->save();
      DB::table('log')->insert(['log_texto' => 'Edito contacto.id Contacto:'.$id.'']);

      return response()->json([
              "mensaje"         => "Contacto Editado"
        ]);
    }


    public function destroy($id)
    {
      $cont = Contactos::find($id);
      $cont->delete();
      DB::table('log')->insert(['log_texto' => 'Elimino contacto.id Contacto:'.$id.'']);

      return response()->json([
              "mensaje"         => "Contacto Borrado"
        ]);
    }

public function show2($id){

    $user = DB::table('contactos')->where('cont_id', $id)->first();
    return json_encode($user);
  //  dd($user->cont_id);
 //return json_encode($contactosCli);
/*return response()->json([
    "id"              => $contactosCli->cont_id,
    "nombre"          => $contactosCli->cont_nombre,
    "apellido"        => $contactosCli->cont_apellido,
    "telefono"        => $contactosCli->cont_telefono,
    "correo"          => $contactosCli->cont_email
]);*/
}

}
