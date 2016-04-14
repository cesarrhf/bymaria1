<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\unidades_ventas;
use App\Models\PresentUniVenta;
use App\Models\Presentaciones;

use View;
use DB;
use Illuminate\Http\Response;

class UnidadesVentasController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

    public function index()
    {
      $univta = DB::select('select *
                             from unidades_ventas
                             where uni_custom =0 or uni_custom= 1 ');
                             return  view('admin.unidadesvta.listar')->with('univta', $univta);

  }

    /*=============  FORMAS DE SELECT EN LOS MODELOS RELACIONADOS MUCHOS A MUCHOS ======
          $test = Presentaciones::has('post4')->get()->toArray();
          $asd=  "2";
        $test=Presentaciones::whereHas('post4', function($q) use ($asd)
          {
              $q->where('univ_un_id', '=', $asd);

          })->get()->toArray();

          $test2=Presentaciones::whereHas('post4', function($q) use ($asd){
                $q->where('univ_un_id', $asd);
            })->get()->toArray();

          dd($test2);
====================================FIN======================================*/






    public function create(Request $request)
    {
        $present    = \App\Models\Presentaciones::all();
        return  view('admin.unidadesvta.form.create')->with('present', $present);
    }




    public function store(Request $request)
    {

        //  dd($request->all());
        $uniVta = new unidades_ventas;
        $path = '/home/bymaria1/public_html/bymaria/imagenes/univta';

        $this->validate($request, [
           'Nombre'      => 'required|min:5',
           'Descripcion' => 'required',
           'Precio'      => 'required|numeric| Min:3',
           'Foto'        => 'required|image|min:1'
         ]);

         if($request->ajax()){

               $file      = $request->file('Foto');
               $nombre    = $file->getClientOriginalName();
               //lo movemos al lugar que deseamos
               $file->move($path, $nombre);
               if ($request->uni_publica=="true") {
                 $valor=1;
               }else {
                 $valor=0;
               }
               if ($request->uni_custom=="true") {
                 $valor2=1;
               }else {
                 $valor2=0;
               }
               $uniVta->uni_cantidad_present = $request->uni_cantidad_present;
               $uniVta->uni_nombre           = $request->Nombre;
               $uniVta->uni_descripcion      = $request->Descripcion;
               $uniVta->uni_precio           = $request->Precio;
               $uniVta->uni_publica          = $valor;
               $uniVta->uni_foto             = $nombre;
               $uniVta->uni_custom           = $valor2;
               $uniVta->save();

              $insertedId               = $uniVta->uni_id;
              DB::table('log')->insert(['log_texto' => 'Creo unidad vta admin. uni_id:'.$insertedId.'.']);

             return response()->json([
                 "uni_id"     => $insertedId,
                 "mensaje"    => "creado"
             ]);
         }else {
           # code...
         }
    }


    public function show($id)
    {
      $present         =  Presentaciones::all();
      $presentAsig     = Presentaciones::whereHas('post4', function($q) use ($id){
                      $q->where('univ_un_id', $id);
                  })->get();
          return view('admin.unidadesvta.form.partials.editUni')->with('present', $present)->with('presentAsig', $presentAsig)->with('id', $id);
     }

    public function edit($id)
    {
      $present    = \App\Models\Presentaciones::where('pres_id_pro', '=', $producto->pro_id)->get();
      return  view('admin.unidadesvta.form.create')->with('present', $present);
    }

    public function cargaimg(Request $request,$id)
    {
   //   dd($request->all());
      $uni          = unidades_ventas::findOrFail($id);
      $path         = '/home/bymaria1/public_html/bymaria/imagenes/univta';
      $file         = $request->file('uni_foto');
      $nombre       = $file->getClientOriginalName();
      $file->move($path, $nombre);
      $uni->uni_foto= $nombre;
      $uni->save();
      DB::table('log')->insert(['log_texto' => 'Actualizo imagen unidad vta admin. uni_vta:'.$id.'.']);

    }

    public function update(Request $request, $id)
    {

 // dd($request->all());
        $uni = unidades_ventas::findOrFail($id);
        if ($request->posi==0) {
          $this->validate($request, [
          'texto'         => 'required'
          ]);
          $uni->uni_nombre       = $request->texto;
        }if ($request->posi==2) {
          $this->validate($request, [
          'texto'         => 'required'
          ]);
            $uni->uni_precio    = $request->texto;
        }if ($request->posi==3) {

          $this->validate($request, [
          'texto'         => 'required'
          ]);

          $uni->uni_publica= $request->texto;

        }if ($request->posi==1) {
          $this->validate($request, [
          'texto'         => 'required'
          ]);
          $uni->uni_descripcion     = $request->texto;
        }
        $uni->save();
        DB::table('log')->insert(['log_texto' => 'Actualizo unidad vta admin. uni_vta:'.$id.'.']);

        return response()->json([
                "mensaje"         => "Unidad Vta Editada"
          ]);
    }


    public function destroy($id)
    {
      $uni = unidades_ventas::findOrFail($id);
      $uni->delete();
      DB::table('log')->insert(['log_texto' => 'Elimino unidad vta admin. uni_vta:'.$id.'.']);

      DB::table('present_uni_ventas')->where('univ_un_id',$id)->delete();
      DB::table('log')->insert(['log_texto' => 'Elimino present_uni_ventas de una unidade de vta borrada. univ_un_id:'.$id.'.']);

      return response()->json([
              "mensaje"         => "Unidad Borrada"
        ]);
    }
}


/* =========PAGINACION ================
  //paginate es el metodo de paginacion donde el numero es la cantidad a mostrar
  $present    = \App\Models\Presentaciones::paginate(4);
  //si es ajax
  if($request->ajax()) {
     // para cargar solo la seccion 'table' de la pagina 'create' renderSections()['table']
       return view('admin.unidadesvta.form.create')->with('present', $present)->renderSections()['table'];
  }
  //si no es ajax
  return  view('admin.unidadesvta.form.create')->with('present', $present);

=========FIN==========  */
