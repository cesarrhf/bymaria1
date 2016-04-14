<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Regiones;
use App\Models\Pedidos;
use App\Models\Despachos;
use App\Models\Items;
use App\Models\unidades_ventas;
use DB;

class PedidosController extends Controller
{
  public function __construct(){
      $this->middleware('auth');
  }

    public function index()
    {
      $ped = Pedidos::all();
      return  view('admin.pedidos.listar')->with('ped', $ped);
    }

    public function create()
    {
        $clientes = Clientes::all();
        // $uniVta   = unidades_ventas::all();
        $uniVta   = DB::table('unidades_ventas')
                    ->where('uni_custom','<>',2)
                    ->get();
        $regiones = Regiones::all();
        return  view('admin.pedidos.form.create')->with('clientes', $clientes)->with('uniVta', $uniVta)->with('regiones', $regiones);
    }


    public function store(Request $request)
    {
          //  dd($request->all());

      $this->validate($request, [
      'fecha_despacho'    => 'required| Min:1',
      'Nombre_Cliente'    => 'required',
      'Apellido_Paterno'  => 'required',
      'Telefono'          => 'required|numeric',
      'Correo'            => 'required|email',
      'numero'            => 'required|numeric',
      'comuna'            => 'required',

    ]);

       $ped = new Pedidos();
        $ped->ped_id_cliente     = $request->ped_id_cliente;
        $ped->ped_despacho       = $request->ped_despacho;
        $ped->ped_fecha_despacho = $request->fecha_despacho;
        $ped->ped_obs_despacho   = $request->ped_obs_despacho;
        $ped->ped_orden_despacho = $request->ped_orden_despacho;
        $ped->ped_cli_nombre     = $request->Nombre_Cliente;
        $ped->ped_cli_materno    = $request->ped_cli_materno;
        $ped->ped_cli_paterno    = $request->Apellido_Paterno;
        $ped->ped_cli_celular    = $request->Telefono;
        $ped->ped_cli_email      = $request->Correo;
        $ped->ped_cli_calle      = $request->Calle;
        $ped->ped_cli_num        = $request->numero;
        $ped->ped_cli_dpto       = $request->ped_cli_dpto;
        $ped->ped_cli_comuna     = $request->comuna;
        // $ped->item_cantidad_pedida => $request->item_cantidad_pedida;
        //  $ped->item_precio_vta =>  $request->item_precio_vta;
        $ped->ped_descuento      = $request->ped_descuento;
        //    $ped->tipo_de_pago => $request->tipo_de_pago;
        $ped->ped_obs_pedido     = $request->ped_obs_pedido;
        $ped->ped_cantidad_item  = $request->ped_cantidad_item;
        $ped->ped_neto           = $request->ped_neto;
        $ped->ped_iva            = $request->ped_iva;
        $ped->ped_total          = $request->ped_total;
        $ped->ped_subtotal       = $request->ped_subtotal;
        //antes de guardar lo guardo tbn en el despacho.
        $despachos               = new Despachos();
        $despachos->despa_fecha  = $request->fecha_despacho;
        $despachos->despa_comuna = $request->comuna;
        $despachos->save();

        DB::table('log')->insert(['log_texto' => 'Guardo en Despacho cuando creo el pedido (admin). Id:'.$despachos->despa_id.'.']);

        $insertedId              = $despachos->despa_id;
        $ped->ped_id_despacho    = $insertedId;
        //nuevos
        $ped->ped_estado_pago    = $request->selectEstadoPago;
        $ped->ped_forma_pago     = $request->selectFormaPago;
        $ped->ped_tipo_pago      = $request->selectTipoPago;

        $ped->ped_coordenadas      = $request->ped_coordenadas;
        $ped->ped_boletaofactura_num   = $request->tipo_de_pago;

        $ped->save();
        DB::table('log')->insert(['log_texto' => 'Guardo el pedido creado por la pagina admin cuando creo el pedido. Id:'.$ped->ped_id.'.']);
        $insertedId = $ped->ped_id;
        return response()->json([
            "id"     => $insertedId,
            "mensaje"    => "creado"
        ]);
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
        //
    }

    public function destroy($id)
    {
        //
    }

     public function uniPack(Request $request){
       $uniVta = new unidades_ventas;
       $uniVta->uni_nombre        = 'Compra Publica';
       $uniVta->uni_descripcion   = 'Esta es una compra echa por un cliente desde la web admin';
       $uniVta->uni_publica       = '0';
       $uniVta->uni_custom        = '2'; // 2 quiefre decir custom
       $uniVta->uni_id_uni_root   = $request->uni_id;  //es la unidad de venta a la cual se referencia.

       $precioUnidadVta = DB::table('unidades_ventas')->where('uni_id',$request->uni_id)->select('uni_foto','uni_nombre','uni_cantidad_present','uni_precio')->get();
      //  $precioUnidadVta = DB::select('select uni_foto from unidades_ventas where uni_id="'.$request->id.'"');
          //  dd($precioUnidadVta[0]->uni_foto);
       $uniVta->uni_cantidad_present =  $precioUnidadVta[0]->uni_cantidad_present;
       $uniVta->uni_foto             =  $precioUnidadVta[0]->uni_foto;
       $uniVta->uni_precio           =  $precioUnidadVta[0]->uni_precio;

       $uniVta->save();

       $insertedId = $uniVta->uni_id;
       DB::table('log')->insert(['log_texto' => 'Creo unidad de venta por la pagina admin cuando creo el pedido. Id:'.$uniVta->uni_id.'. ID pedido '.$request->Pedid.'']);

       $items = new Items();
       $items->item_uni_id          = $insertedId;
       $items->item_ped_id          = $request->Pedid;
       $items->item_precio_vta      = $request->precio;
       $items->item_cantidad_pedida = $request->cantidad;
       $items->item_nombre          = $precioUnidadVta[0]->uni_nombre;
       $items->save();
       DB::table('log')->insert(['log_texto' => 'Creo Item por admin cuando creo el pedido. Id:'.$uniVta->uni_id.'.ID pedido:'.$request->Pedid.'']);

       return response()->json([
           "id"         => $insertedId,
           "mensaje"    => "insertado"
       ]);

     }
    public function InsertPack(Request $request){
      // dd($request->all());
      //agrego la presentacion en la tabla presnt_uni_vta
     $id_new =  DB::table('present_uni_ventas')->insertGetId(['univ_pres_id' =>$request->pres_escogida , 'univ_un_id' => $request->item_uni_id]);

      DB::table('log')->insert(['log_texto' => 'Creo presentaciones de unidades de ventas por admin cuando creo el pedido.
                                                Id:'.$id_new.'.ID presentacion:'.$request->pres_escogida.'.
                                                id unidade vta:'.$request->item_uni_id.' ']);
       return response()->json([
           "mensaje"    => "insertado"
       ]);

    }


    public function NuevoPack(Request $request)
    {
      $misweas = DB::select('select *
                             from present_uni_ventas pvt, presentaciones pt, unidades_ventas uni
                              where uni.uni_id ='.$request->id.'
                             and uni.uni_id  = pvt.univ_un_id
                             and pvt.univ_pres_id= pt.pres_id');

      return response()->json($misweas);
    }


}
