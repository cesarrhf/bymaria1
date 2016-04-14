<?php

namespace App\Http\Controllers;

 //use  Request;

use App\Models\Productos;
use App\Models\Presentaciones;
use Illuminate\Http\Request;

use App\Http\Requests\CrearProductoRequest;
use Illuminate\Support\Session;

use Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use Redirect;
use Illuminate\Routing\Route;
 use DB;

class ProductosController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }
  public function index()
  {
    //esta ruta es sin el index !!
      return  view('admin.productos.index');
  }

  public function create()
  {
    //  $myplace = "admin.productos.form.crearPro";
      return  view('admin.productos.form.create');
  }



  public function listar()
  {
      $productos = \App\Models\Productos::paginate(2);
      return view('admin.productos.listar')->with('productos', $productos);
  }


  public function edit($id)
  {

    $producto   = \App\Models\Productos::find($id);
    $present    = \App\Models\Presentaciones::where('pres_id_pro', '=', $producto->pro_id)->get();

    return view('admin.productos.form.edit')->with('producto', $producto)->with('present', $present);

  }

//la id esta en el form, por eso no es necesario llevarlo por otro lado =)
  public function upImgPro($id, Request $request){

    // $path = '/home/bymaria1/public_html/bymaria/imagenes/productos';
    $path =  '/Applications/MAMP/htdocs/ByMaria2/home/bymaria1/public_html/bymaria/imagenes/productos';

    $producto =  Productos::findOrFail($id);

      if (isset($request->pro_foto)){
        //obtenemos el campo file definido en el formulario
        $file      = $request->file('pro_foto');
        $nombre    = $file->getClientOriginalName();
        //lo movemos al lugar que deseamos
        $file->move($path, $nombre);
        $producto->pro_nombre      = $request->pro_nombre;
        $producto->pro_descripcion = $request->pro_descripcion;
        $producto->pro_foto        = $nombre;
        $producto->save();

        $mensaje = 'Foto actualizada';

      }if (isset($request->pro_foto_trasera)) {
        $file       = $request->file('pro_foto_trasera');
        $nombre2    = $file->getClientOriginalName();
        $file->move($path, $nombre2);
        $producto->pro_foto_trasera        = $nombre2;
        $producto->save();
        $mensaje = 'Foto actualizada';
      }
      else{
        $producto->pro_nombre      = $request->pro_nombre;
        $producto->pro_descripcion = $request->pro_descripcion;
        $producto->save();
        $mensaje = 'Datos de producto actualizados';
      }
      DB::table('log')->insert(['log_texto' => 'Edito la foto de producto. Id Pro:'.$producto->pro_id.'.']);

         if ($request->ajax()) {
           if (isset($nombre) ) {
             return response()->json([
               'nombre'   => $request->pro_nombre,
               'mensaje'  => $mensaje,
               'pro_foto' => $nombre
             ]);


           }
           if (isset($nombre2) ) {
             return response()->json([
               'nombre'  => $request->pro_nombre,
               'mensaje'=> $mensaje,
               'pro_foto_trasera' => $nombre2
             ]);


           }else{
             return response()->json([
               'nombre'  => $request->pro_nombre,
               'mensaje'=> $mensaje,
               'pro_foto' => 0
             ]);
           }

        }
  }
  public function show($id)
    {
        //
    }
    public function store(Request $request)
    {
       // dd($request->all());
    $this->validate($request, [
        'Nombre'           => 'required|min:5',
        'Descripcion'      => 'required',
        'Foto_Principal'             => 'required|image|min:1',
        'Foto_Trasera'     => 'required|image|min:1'
      ]);



        if($request->ajax()){

          // $path =  '/home/bymaria1/public_html/bymaria/imagenes/productos';
          $path =  '/Applications/MAMP/htdocs/ByMaria2/home/bymaria1/public_html/bymaria/imagenes/productos';

          $producto = new Productos;

            if ($request->pro_foto!="undefined"){
              //obtenemos el campo file definido en el formulario
              $file       = $request->file('Foto_Principal');
              $nombre     = $file->getClientOriginalName();
              $file->move($path, $nombre);
              $file2      = $request->file('Foto_Trasera');
              $nombre2    = $file2->getClientOriginalName();
              $file2->move($path, $nombre2);
              $producto->pro_foto_trasera        = $nombre2;
              $producto->pro_foto        = $nombre;

              $producto->pro_nombre      = $request->Nombre;
              $producto->pro_descripcion = $request->Descripcion;
              $producto->save();

            }


            else{
              $producto->pro_nombre      = $request->pro_nombre;
              $producto->pro_descripcion = $request->pro_descripcion;
              $producto->pro_foto        = "";
              $producto->save();
            }
            $insertedId = $producto->pro_id;
            DB::table('log')->insert(['log_texto' => 'Edito producto. Id Pro:'.$insertedId.'.']);

            return response()->json([
                "producto_id"     => $insertedId,
                "producto_nombre" => $request->pro_nombre,
                "mensaje"         => "creado"
            ]);
        }else {
          # code...
        }
    }


}


/*/le paso los valores para validar!!
public function guardar(CrearProductoRequest $request)
{

//AQUI LE PASO LOS VALORES VALIDADOS
 Productos::create($request->all());
    //redirecciono a la ruta
      return redirect('crear');
}
*/



/*
  //todo lo que manda el form lo recibe input
  $input =  Request::all();
  //otra fortma de guardar . OJO QUE TIENE QUE TENER LOS INPUT EL MISMO QUE LA TABLA
  Productos::create($input);
  */

/*  ESTA ES UNA FORMA DE GUARDAR POR INPUT

  $productos =  new Productos;
  $productos->pro_nombre = Request::get('pro_nombre');
  $productos->pro_desc   = Request::get('pro_descripcion');
  $productos->save();
  */


  //un solo input especifico
//  $nombre =  Request::get('name');
