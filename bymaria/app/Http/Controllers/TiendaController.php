<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Regiones;
use App\Models\Presentaciones;
use App\Models\PresentUniVenta;
use App\Models\unidades_ventas;
use App\Models\Pedidos;
use App\Models\Despachos;
use App\Models\Items;
use Session;
use DB;
use Response;
use File;
use Mail;
use Storage;


class TiendaController extends Controller
{

  public function listarZona(Request $request)
  {
    //  dd($request->all());
     $mis_wewwewew = DB::select('select * from zonas z, zonasCoordenadas zc
                                  where z.zona_id = zc.zc_zona_id;');
    $band=true;
    $band2=0;
    $mypass;
    foreach($mis_wewwewew as $key=>$z){
        if ($band==true && $band2!=$z->zona_id) {
          $band2 = $z->zona_id;
          $mypass = password_hash($z->zona_id, PASSWORD_DEFAULT);
          $mis_wewwewew[$key]->zona_id = $mypass;
          $band = false;
        }elseif ($band==false && $band2==$z->zona_id) {
            $mis_wewwewew[$key]->zona_id = $mypass;
        }elseif ($band==false && $band2!=$z->zona_id) {
          $band2 = $z->zona_id;
          $mypass = password_hash($z->zona_id, PASSWORD_DEFAULT);
          $mis_wewwewew[$key]->zona_id = $mypass;
        }
    }
     return json_encode($mis_wewwewew);
  }


  public function borroItems(Request $request)
  {
          // dd($request->all());
        $id_cookie = $_COOKIE['idUsuario'];
        //DB::table('Items')->where(['item_vid' , $id_cookie],['item_uni_id' ,$request->id])->delete();
        DB::delete('delete from items where item_vid="'. $id_cookie.'" and item_uni_id="'.$request->id.'" ');

        DB::table('log')->insert(['log_texto' => 'Borro Item tienda. item_vid:'.$id_cookie.'. ID unidadvta: '.$request->id.'']);

          $misUni =   DB::table('unidades_ventas')->where('uni_id', $request->id)->where('uni_custom', 2)->get();

          if (!empty($misUni)) {
            //borro si es que se saco un unidad vta temporal.
            DB::table('present_uni_ventas')->where('univ_un_id',$request->id)->delete();
            DB::table('unidades_ventas')->where('uni_id',$request->id)->where('uni_custom','2')->delete();
            DB::table('log')->insert(['log_texto' => 'Borro present_uni_ventas y en unidades ventas desde la tienda. univ_un_id:'.$request->id.'.']);
            }

        return response()->json([
            "mensaje"         => "Item Borrado"
       ]);
  }

  public function agregarPvt(Request $request){
    //insertar en la tabla present_uni_ventas
    $uniVta               = new PresentUniVenta;
    $uniVta->univ_un_id   = $request->iduni;
    $uniVta->save();
    $insertedId           = $uniVta->univ_id;
    DB::table('log')->insert(['log_texto' => 'Creo unidad Presentacion unidadvta desde la tienda. uni_id:'.$insertedId.'.']);

    return response()->json([
        "id"      => $insertedId,
        "mensaje" => "creado"
    ]);
  }

  public function nuevoPublico(Request $request){

    $uniVta = new unidades_ventas;

    $uniVta->uni_nombre        = 'Compra Publica';
    $uniVta->uni_descripcion   = 'Esta es una compra echa por un cliente desde la web publica';
    $uniVta->uni_publica       = '0';
    $uniVta->uni_foto          = '0';
    $uniVta->uni_custom        = '2';
    $uniVta->uni_cantidad_present        = $request->cantidad;
    $uniVta->uni_foto          = $request->nombreFoto;
    $uniVta->uni_id_uni_root   = $request->id;
    //copio el precio del padre
    $precioUnidadVta = DB::select('select uni_precio as precio
                         from unidades_ventas
                         where uni_id ="'.$request->id.'"');

    $uniVta->uni_precio        =  $precioUnidadVta[0]->precio;

    $uniVta->save();
    $insertedId = $uniVta->uni_id;

    DB::table('log')->insert(['log_texto' => 'Creo unidad unidadvta custom desde la tienda. uni_id:'.$insertedId.'.']);

    //insertar en la tabla present_uni_ventas
     $mis_present_copy = DB::select('select pt.pres_id, pt.pres_nombre,pt.pres_foto
                                      from present_uni_ventas pvt, presentaciones pt
                                      where pvt.univ_un_id='.$request->id.'
                                      and pvt.univ_pres_id = pt.pres_id');


    // foreach($mis_present_copy as $obj){
    //   DB::table('Present_uni_ventas')->insert(['univ_un_id' => $insertedId]);
    // }
    $mis_present_copy['uni_id']=$insertedId;
    //array_push($mis_present_copy,"uni_id" , $insertedId);
    return response()->json($mis_present_copy);
  }

  //item agregados desde la tienda.
   public function agregoItems(Request $request)
   {
     $id_cookie = $_COOKIE['idUsuario'];
     if ($request->ajax()) {
          // $items = new Items();
          // $items->item_uni_id          = $request->iduni;
          // $items->item_nombre          = $request->nombrePro;
          //sacar el precio desde la bd tomando el iduni.
          $precioUnidadVta = DB::select('select uni_precio as precio
                                         from unidades_ventas
                                         where uni_id ="'.$request->iduni.'"');
          //
          // $items->item_precio_vta      = $precioUnidadVta[0]->precio;
          // $items->item_vid             = $id_cookie;
          // $items->item_cantidad_pedida = 1;
          // $items->save();
          // $inserted_id                = $items->item_id;
          $id = DB::table('items')->insertGetId(
                                    ['item_uni_id' => $request->iduni,
                                     'item_nombre' => $request->nombrePro,
                                     'item_precio_vta' => $precioUnidadVta[0]->precio,
                                     'item_vid' => $id_cookie,
                                     'item_cantidad_pedida' => 1]);

          // dd($items->item_vid.' '.$items->item_precio_vta.' '.$items->item_cantidad_pedida.' '.$inserted_id);

          DB::table('log')->insert(['log_texto' => 'Creo items desde la tienda.ID items:'.$id .'. id usua:'.$id_cookie .'']);

         return response()->json([
           'mensaje' => 'Insertado'
       ]);
     }
   }

    public function addPress(Request $request){
      DB::table('present_uni_ventas')->where('univ_id', $request->idUnidadVta)->update(['univ_pres_id' =>  $request->idPresentacion ]);
      DB::table('log')->insert(['log_texto' => 'Actualizo presentaciones unidad vta desde la tienda.
                                                univ_id:'. $request->idUnidadVta .'. univ_pres_id:'.  $request->idPresentacion .'']);

    }

    public function index()
    {
      $listPro = DB::select('select *
                             from unidades_ventas
                             where uni_publica =1
                             and uni_custom =0 or uni_custom= 1 order by uni_orden ');


      if (isset($_COOKIE['idUsuario'])){
          $misesion = $_COOKIE['idUsuario'];
         //mis item o unidades de ventas o el carrito.
          $micarro = DB::select('select it.item_uni_id,it.item_nombre, it.item_cantidad_pedida, it.item_precio_vta, it.item_precio_vta,vt.uni_id,
                                vt.uni_custom, vt.uni_cantidad_present, vt.uni_id_uni_root
                                from items it, unidades_ventas vt
                                where item_vid = "'.$misesion.'"
                                and it.item_uni_id = vt.uni_id');
//estos son los que tengo seleccionados
         $mis_pack = DB::select(' select *
                              from   present_uni_ventas pvt, unidades_ventas vt, items it
                              where vt.uni_id = pvt.univ_un_id
                              and vt.uni_custom =2
                              and it.item_vid = "'.$misesion.'"
                              and vt.uni_id = it.item_uni_id;');
        // $misweas = DB::select('select pt.pres_id, vt.uni_id, pt.pres_nombre, pvt.univ_id
        //                       from   present_uni_ventas pvt, unidades_ventas vt,presentaciones pt
        //                       where vt.uni_id = pvt.univ_un_id
        //                       and vt.uni_custom =1
        //                        and pt.pres_id = pvt.univ_pres_id  ');

// -- lo que contiene mis pack
        $misweas = DB::select('select pt.pres_id, vt.uni_id, pt.pres_nombre,pres_foto,vt.uni_id
                              from   present_uni_ventas pvt, unidades_ventas vt,presentaciones pt
                              where vt.uni_id = pvt.univ_un_id
                              and vt.uni_custom =1
                               and pt.pres_id = pvt.univ_pres_id ;');


        //  $mis_pack = DB::select('select pt.pres_id, vt.uni_id, pt.pres_nombre
        //                         from   present_uni_ventas pvt, unidades_ventas vt,presentaciones pt
        //                         where vt.uni_id = pvt.univ_un_id
        //                         and vt.uni_custom =1
        //                         and pt.pres_id = pvt.univ_pres_id');
        // dd($micarro);
          return view('tienda')->with('listPro', $listPro)->with('micarro', $micarro)->with('mis_pack', $mis_pack)->with('misweas', $misweas);
       }
      else{
        //  genero una nueva cookie session.
        $vID	=	uniqid().date("YmdHis");
        setcookie("idUsuario", $vID, time()+3600*24*30*12, "/");
        return view('tienda')->with('listPro', $listPro);
      }

    }
    public function medioPago(Request $request){
           return view('medioPago')->with('request', $request);
    }


    public function ultimoPasoTienda (Request $request)
    {
      // dd($request->all());
       $band   = false;
       $precio =0;
       //si mi pass es 0
       if(password_verify(0, $request->costo_envio)){
         $view = \View::make('medioPago')->with('request', $request)->with('micontenido', $request->all())->with('precio',$precio)->with('hash', $request->costo_envio);
         $sections = $view->renderSections();
         return Response::json($sections['test']);
       }else{
         $zonas = DB::select('select * from zonas');
         foreach ($zonas as $key => $value) {
           if(password_verify($value->zona_id, $request->costo_envio)){
          //  echo $value->zona_id;
            $precio = $value->zona_precio;
           $band = true;
           break;
          }
         }
         if ($band == false) {
              echo 'no esta';
              DB::table('log')->insert(['log_texto' => 'No concuerda el cifrado de la zona de despacho con la base de datos. El usuario es:'.$_COOKIE['idUsuario'].'.']);
              // return redirect()->action('TiendaController@index');
            }else{
              $view = \View::make('medioPago')->with('request', $request)->with('micontenido', $request->all())->with('precio',$precio)->with('hash', $request->costo_envio);
              $sections = $view->renderSections();
              return Response::json($sections['test']);
            }
       }


    }


     public function store(Request $request)
     {
        //  dd($request->all());
       $band   = false;
       $precio =0;
       if(password_verify(0, $request->hash)){
      //  echo $value->zona_id;
       $band = true;
       }else{
         $zonas = DB::select('select * from zonas');
         foreach ($zonas as $key => $value) {
           if(password_verify($value->zona_id, $request->hash)){
          //  echo $value->zona_id;
              $precio = $value->zona_precio;
           $band = true;
           break;
          }
         }
       }
       if ($band == false) {
            echo 'no esta';
            DB::table('log')->insert(['log_texto' => 'No concuerda el cifrado de la zona de despacho con la base de datos. El usuario es:'.$_COOKIE['idUsuario'].'.']);
            // return redirect()->action('TiendaController@index');
          }else{

                  // $misesion = Session::get('miSesion');
                     $misesion = $_COOKIE['idUsuario'];
                     $path = public_path().'/imagenes/univta';

                     $ped = new Pedidos();
                     $ped->ped_id_cooki       = $misesion;
                     $ped->ped_cli_nombre     = $request->nombre;
                     //$ped->ped_cli_materno    = $request->ped_cli_materno;
                     $ped->ped_cli_paterno    = $request->apellido;
                     $ped->ped_cli_celular    = $request->telefono;
                     $ped->ped_cli_email      = $request->email;
                     $ped->ped_cli_calle      = $request->calle;
                     $ped->ped_cli_num        = $request->numero;
                     $ped->ped_cli_dpto       = $request->dpto;
                     $ped->ped_cli_comuna     = $request->comuna;
                     $ped->ped_coordenadas    = $request->coordenadas;
                     $ped->ped_despacho       =  $precio;

                     //sacar desde la bd la cantidad de item y el subtotal por el idsession
                     $sumaCantidad = DB::select('select sum(item_precio_vta*item_cantidad_pedida) as total, sum(item_cantidad_pedida) as suma
                                                from items
                                                where item_vid ="'.$misesion.'"');
                     $ped->ped_cantidad_item = $sumaCantidad[0]->suma;
                     $ped->ped_subtotal      = $sumaCantidad[0]->total;
                     $ped->ped_total         = $sumaCantidad[0]->total + $precio;
                     $total_trans            = $sumaCantidad[0]->total + $precio;
                     //antes de guardar lo guardo tbn en el despacho.
                     $despachos               = new Despachos();
                     $despachos->despa_comuna = $request->comuna;
                     $despachos->save();

                     DB::table('log')->insert(['log_texto' => 'Creo despachos desde la tienda. id despa:'.$despachos->despa_id.'.']);

                     $insertedIdDespa         = $despachos->despa_id;

                     $ped->ped_id_despacho    = $insertedIdDespa;
                     $ped->save();
                     $insertedId = $ped->ped_id;

                     DB::table('log')->insert(['log_texto' => 'Creo pedido desde la tienda. id ped:'.$insertedId.'.']);

                     //agrego el id del pedido a los item y borro el idcookie del item.

                     DB::table('items')
                       ->where('item_vid', $misesion)
                       ->update(['item_ped_id' => $insertedId,'item_vid' => '' ]);

                       DB::table('log')->insert(['log_texto' => 'Actualizo items sacandole el vid cuando creo el pedido desde la tienda. item_vid:'.$misesion.'.']);

                      //pregunto si es transferencia o webpay 1 es transferencia
                      if ($request->miRadio=='1') {
                        DB::table('pedidos')
                          ->where('ped_id', $insertedId)
                          ->update(['ped_forma_pago' => 'transferencia','ped_estado_pago' => 'en proceso' ]);

                        DB::table('log')->insert(['log_texto' => 'Actualizo en pedidos la forma de pago transferencia desde la tienda.ped_id:'.$insertedId.'.']);

                        return $this->email($request,$insertedId,$precio);
                      }else{
                         //crear archivo para el webpay
                         $TBK_ID_SESION		= time();
                         $linea					= $total_trans . "00;" . $insertedId;
                         $monto         = $total_trans * 100;
                        //  $monto         = (int)$monto+(int)$precio;
                         File::put('/home/bymaria1/bymaria/storage/dato'.$TBK_ID_SESION.'.txt', $linea);

                         return response()->json([
                             "TBK_ORDEN_COMPRA"  =>$insertedId,
                             "TBK_MONTO"         =>$monto,
                             "TBK_ID_SESION"     =>$TBK_ID_SESION
                          ]);
                      }
          }
     }



   function updateCant(Request $request)
    {
        $misesion = $_COOKIE['idUsuario'];
        DB::update('update items
                    set item_cantidad_pedida = "'.$request->cantidad.'"
                    where item_vid = "'.$misesion.'"
                    and  item_uni_id ="'.$request->id.'" ');

        DB::table('log')->insert(['log_texto' => 'Actualizo cantidad de items desde la tienda.item_vid:'.$misesion.'. item_uni_id:'.$request->id.'. Nueva Cantidad:'.$request->cantidad.'']);
        return response()->json([
          'mensaje' => 'actualizado'
      ]);
    }

    public function consultPresent(Request $request)
    {
      $presentacion = DB::select('select pt2.pres_id, pt2.pres_foto, pt2.pres_nombre, vt.uni_id, vt.uni_cantidad_present
                              from unidades_ventas vt, present_uni_ventas pt, presentaciones pt2
                              where pt.univ_un_id = vt.uni_id
                              and pt.univ_pres_id = pt2.pres_id
                              and vt.uni_custom = 1
                              and vt.uni_id = '.$request->idUNivta.';');
      return json_encode($presentacion);
    }

    public function resumen(Request $request)
    {

      $misesion = $_COOKIE['idUsuario'];
      $micarro  = DB::select('select *
                              from items i, unidades_ventas uv
                              where i.item_vid = "'.$misesion.'"
                              and i.item_uni_id = uv.uni_id');
       $region = Regiones::all();
       return view('resumen')->with('region', $region)->with('micarro',$micarro);
    }

    public function email(Request $request, $ped_id,$precio_despacho){
    //  dd($request->all());
           //con el subtotal.
           $mis_datos = $request->all();
           $mis_datos['ped']=$ped_id;
           //item que compre.
           $mis_item = DB::select('select it.item_cantidad_pedida, it.item_precio_vta, it.item_nombre, vt.uni_foto,it.item_uni_id
                                  from items it, unidades_ventas vt
                                  where item_ped_id= '.$ped_id.'
                                  and it.item_uni_id = vt.uni_id');
          $mensaje='';
          $sum_total = 0;
        	foreach($mis_item as $i){
           	$mensaje .= "
            <tr style='text-transform: uppercase;'>
              <td style='text-align:left'><img src='http://www.bymaria.cl/bymaria/imagenes/univta/{$i->uni_foto}' height=50 width=50></td>
            	<td style='text-align:left'> {$i->item_nombre}</td>
            	<td style='text-align:center'>{$i->item_cantidad_pedida}</td>
            	<td style='text-align:center'>$";
            		$mensaje .= number_format($i->item_precio_vta * $i->item_cantidad_pedida,0,",",".");
            		$mensaje .= "</td>
            </tr>";
        	}
          $mis_datos['items']   =$mensaje;
          $mis_datos['despacho']=$precio_despacho;
          Mail::send('emails.nuevo_pedido_transferencia',  $mis_datos, function($message) use ($mis_datos){
              $message->to('chermosilla@cecsoluciones.cl');
              $message->cc($mis_datos['email']);
              $message->from('bymaria@bymaria.cl');
              $message->subject('Pedido ByMaria');
          });
          DB::table('eventos')->insert(['evento_texto' => 'Envio correo de transferencia por la tienda. Pedido: '.$ped_id.'. Correo:'.$mis_datos['email'].'.']);

          $view = \View::make('exito')->with('micarro',$mis_item)->with('miTotalFinalfinal',$request->total)->with('datosComprador',$mis_datos)->with('precio_despacho', $precio_despacho);
          $sections = $view->renderSections();
          return Response::json($sections['test']);

    }

    public function webpayExito(Request $request){
      //dd($request->all());

      $log_path			= '/home/bymaria1/bymaria/storage/MAC01Normal'.$request->TBK_ID_SESION.'.txt';
      $linea        = File::get($log_path);
      $detalle	    = explode("&", $linea);

      $TBK_ORDEN_COMPRA2		  	= explode("=", $detalle[0]);
    	$TBK_TIPO_TRANSACCION	  	= explode("=", $detalle[1]);
    	$TBK_RESPUESTA			    	= explode("=", $detalle[2]);
    	$TBK_MONTO			       		= explode("=", $detalle[3]);
    	$TBK_CODIGO_AUTORIZACION	= explode("=", $detalle[4]);
    	$TBK_FINAL_NUMERO_TARJETA	= explode("=", $detalle[5]);
    	$TBK_FECHA_CONTABLE		  	= explode("=", $detalle[6]);
    	$TBK_FECHA_TRANSACCION		= explode("=", $detalle[7]);
    	$TBK_HORA_TRANSACCION	  	= explode("=", $detalle[8]);
    	$TBK_ID_TRANSACCION		  	= explode("=", $detalle[10]);
    	$TBK_TIPO_PAGO			    	= explode("=", $detalle[11]);
    	$TBK_NUMERO_CUOTAS		  	= explode("=", $detalle[12]);
    	$TBK_MAC							    = explode("=", $detalle[13]);
       //saco los datos del cliente en el pedido.
      $mis_datos = DB::table('pedidos')
            ->select('ped_cli_nombre','ped_cli_calle','ped_cli_num','ped_cli_dpto', 'ped_cli_email','ped_cli_paterno','ped_cli_comuna','ped_despacho','ped_subtotal')
            ->where('ped_id',$TBK_ORDEN_COMPRA2[1])
            ->first();

      DB::table('log')->insert(['log_texto' => 'WEBPAY EXITO.  saco los datos del cliente en el pedido.. ped_id:'.$TBK_ORDEN_COMPRA2[1].'.']);

          $array['nombre']  = $mis_datos->ped_cli_nombre;
          $array['apellido']= $mis_datos->ped_cli_paterno ;
          $array['comuna']  = $mis_datos->ped_cli_comuna;
          $array['calle']   = $mis_datos->ped_cli_calle;
          $array['numero']  = $mis_datos->ped_cli_num;
          $array['dpto']    = $mis_datos->ped_cli_dpto;
          $array['email']   = $mis_datos->ped_cli_email;
          $precio_despacho  = $mis_datos->ped_despacho;
          $miTotalFinalfinal= $mis_datos->ped_subtotal;
          $array['ped']     = $TBK_ORDEN_COMPRA2[1];

          $arrayTarjeta['tipoPago']       =$TBK_TIPO_PAGO[1];
          $arrayTarjeta['codigo_aut']     =$TBK_CODIGO_AUTORIZACION[1];
          $arrayTarjeta['cuotas']         =$TBK_NUMERO_CUOTAS[1];
          $arrayTarjeta['id_trans']       =$TBK_ID_TRANSACCION[1];
          $arrayTarjeta['fecha_trans']    =$TBK_FECHA_TRANSACCION[1];
          $arrayTarjeta['fecha_contable'] =$TBK_FECHA_CONTABLE[1];

          //dd($arrayTarjeta);
      $mis_item = DB::select('select it.item_cantidad_pedida, it.item_precio_vta, it.item_nombre, vt.uni_foto,it.item_uni_id
                             from items it, unidades_ventas vt
                             where item_ped_id= '.$TBK_ORDEN_COMPRA2[1].'
                             and it.item_uni_id = vt.uni_id');

      return view('exitopay')->with('micarro',$mis_item)->with('datosComprador',$array)->with('precio_despacho', $precio_despacho)->with('miTotalFinalfinal', $miTotalFinalfinal);

    }

    public function webpayFracaso(Request $request){
      $misesion = $_COOKIE['idUsuario'];
      DB::table('log')->insert(['log_texto' => 'WEBPAY FRACASO. selecciono los item del pedido fracaso. item_ped_id:'.$request->TBK_ORDEN_COMPRA.'']);
      //copio los item del fracaso.
      $micarro_nuevo = DB::select('select *
                                  from items
                                  where item_ped_id = '.$request->TBK_ORDEN_COMPRA.'');

    foreach($micarro_nuevo as $i){
     DB::table('items')->insert(['item_uni_id'          => $i->item_uni_id,
                                 'item_cantidad_pedida' => $i->item_cantidad_pedida,
                                 'item_precio_vta'      => $i->item_precio_vta,
                                 'item_nombre' => $i->item_nombre,
                                 'item_vid'    => $misesion ]);
     DB::table('log')->insert(['log_texto' => 'WEBPAY FRACASO. copio los item del fracaso. Item_vid:'.$misesion.'. item_uni_id:'.$i->item_uni_id.' ']);
   }

    return view('fracaso');
    }

    public function webpayCierre(Request $request){
       //solo para saber que sucede
        File::put('/home/bymaria1/bymaria/storage/vista.txt', 'some');

      $cadejaa ='TBK_ORDEN_COMPRA='.$request->TBK_ORDEN_COMPRA;
      $cadejaa =$cadejaa.'&TBK_TIPO_TRANSACCION='.$request->TBK_TIPO_TRANSACCION;
      $cadejaa =$cadejaa.'&TBK_RESPUESTA='.$request->TBK_RESPUESTA;
      $cadejaa =$cadejaa.'&TBK_MONTO='.$request->TBK_MONTO;
      $cadejaa =$cadejaa.'&TBK_CODIGO_AUTORIZACION='.$request->TBK_CODIGO_AUTORIZACION;
      $cadejaa =$cadejaa.'&TBK_FINAL_NUMERO_TARJETA='.$request->TBK_FINAL_NUMERO_TARJETA;
      $cadejaa =$cadejaa.'&TBK_FECHA_CONTABLE='.$request->TBK_FECHA_CONTABLE;
      $cadejaa =$cadejaa.'&TBK_FECHA_TRANSACCION='.$request->TBK_FECHA_TRANSACCION;
      $cadejaa =$cadejaa.'&TBK_HORA_TRANSACCION='.$request->TBK_HORA_TRANSACCION;
      $cadejaa =$cadejaa.'&TBK_ID_SESION='.$request->TBK_ID_SESION;
      $cadejaa =$cadejaa.'&TBK_ID_TRANSACCION='.$request->TBK_ID_TRANSACCION;
      $cadejaa =$cadejaa.'&TBK_TIPO_PAGO='.$request->TBK_TIPO_PAGO;
      $cadejaa =$cadejaa.'&TBK_NUMERO_CUOTAS='.$request->TBK_NUMERO_CUOTAS;
      $cadejaa =$cadejaa.'&TBK_VCI='.$request->TBK_VCI;
      $cadejaa =$cadejaa.'&TBK_MAC='.$request->TBK_MAC;

    //creo el archivo MAC. El mac es el que contiene todo el post del cgi
      File::put('/home/bymaria1/bymaria/storage/MAC01Normal'.$request->TBK_ID_SESION.'.txt', $cadejaa);

      DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE. creo archivo MAC. Sesion:'.$request->TBK_ID_SESION.'.']);


      // tomar los datos que envia transbank
      $monto_email		 = number_format($request->TBK_MONTO/100,0,",",".");
      $TBK_FECHA_TRANSACCION	= substr($request->TBK_FECHA_TRANSACCION, 2, 2) . "-" . substr($request->TBK_FECHA_TRANSACCION, 0, 2) . "-" . date("Y");
    	$TBK_HORA_TRANSACCION	  = substr($request->TBK_HORA_TRANSACCION, 0, 2) . ":" . substr($request->TBK_HORA_TRANSACCION, 2, 2) . ":" . substr($request->TBK_HORA_TRANSACCION, 4, 2);
      switch($request->TBK_RESPUESTA){
    		case 0:
    			$respuesta_texto = "Transacción Aprobada";
    			break;
    		case -1:
    			$respuesta_texto = "Rechazo de Transacción";
    			break;
    		case -2:
    			$respuesta_texto = "Transacción Debe Reintentarse";
    			break;
    		case -3:
    			$respuesta_texto = "Error en Transacción";
    			break;
    		case -4:
    			$respuesta_texto = "Rechazo de Transacción";
    			break;
    		case -5:
    			$respuesta_texto = "Rechazo por error de tasa";
    			break;
    		case -6:
    			$respuesta_texto = "Excede cupo máximo mensual";
    			break;
    		case -7;
    			$respuesta_texto = "Excede límite diario por transacción";
    			break;
    		case -8;
    			$respuesta_texto = "Rubro no autorizado";
    			break;
    	}
      DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE.'.$respuesta_texto.'.']);

        //mi bandera
        $acepta = false;
        //leo mi archivo dato para corroborar
        $log_path			= '/home/bymaria1/bymaria/storage/dato'.$request->TBK_ID_SESION.'.txt';
        DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE.path de dato '.$log_path.'.']);

        $linea        = File::get($log_path);
        DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE.abro el archivo dato'.$request->TBK_ID_SESION.'.txt, '.$linea.'']);

        //saco las comas
        // $detalle      = array_map('trim', explode(';', $linea));
        $detalle      = explode(';', $linea);
        DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE.saco comas el archivo dato'.$request->TBK_ID_SESION.'.txt, '.$detalle[0].', '.$detalle[1].'']);

        $monto 		  	= $detalle[0];
        $ordenCompra	= $detalle[1];
        $respuesta_texto = $respuesta_texto.','.$monto.','.$ordenCompra;
        //veo la respuesta?

        $mimensaje = "";
        if ($request->TBK_RESPUESTA =="0") {
          $mimensaje = "ACEPTADO";
          $acepta    = true;
        }else{
          $mimensaje = "RECHAZADO";
          $acepta    = false;
          DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE. rechazado por tbk_respuesta.'.$respuesta_texto.'']);

        }
        //verifico los valores.
        if($request->TBK_MONTO == $monto &&
           $request->TBK_ORDEN_COMPRA ==  $ordenCompra &&
           $acepta == true){
           $acepta = true;
           $mimensaje = "ACEPTADO";
      	}else{
      		$acepta = false;
          $mimensaje = "RECHAZADO";
          DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE. rechazado por discordancia de valores archivo y el request.tbk_monto:'.$request->TBK_MONTO.'. Monto:'.$monto.'. tbk_orden_compra:'.$request->TBK_ORDEN_COMPRA.'. ordenCompra:'.$ordenCompra.'']);
      	}
        $ruta_mac       = '/home/bymaria1/bymaria/storage/MAC01Normal'.$request->TBK_ID_SESION.'.txt';
        $cmdline				= "/home/bymaria1/public_html/cgi-bin/tbk_check_mac.cgi " . $ruta_mac;

      	if( $acepta == true ){
          DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE. Voy a la aplicacion webpay cgi. Sesion:'.$request->TBK_ID_SESION.'.Ped_id:'.$request->TBK_ORDEN_COMPRA.'']);
      		exec($cmdline, $result, $retint);
      		if($result[0] == "CORRECTO"){
            DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE. aplicacion webpay acepto cgi. Sesion:'.$request->TBK_ID_SESION.'.Ped_id:'.$request->TBK_ORDEN_COMPRA.'']);
      			$acepta = true;
      		}else{
            DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE. aplicacion webpay NO ACEPTO cgi. Sesion:'.$request->TBK_ID_SESION.'.Ped_id:'.$request->TBK_ORDEN_COMPRA.'']);
      			$acepta = false;
      		}
      	}
///
        if($acepta == true){
          //solo para saber que sucede
          // File::put('/home/cec/ByMaria2/storage/vista'.$request->TBK_ID_SESION.'.txt', $respuesta_texto);
          DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE.todos los pasos de webpay listos, se actualizara pedidos. Ped_id:'.$request->TBK_ORDEN_COMPRA.'.']);

          //cambio el estado del pedido a pagado.
          DB::table('pedidos')
            ->where('ped_id', $request->TBK_ORDEN_COMPRA)
            ->update(['ped_forma_pago' => 'webpay','ped_estado_pago' => 'pagado' ]);

         DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE.cambio el estado del pedido a pagado. Ped_id:'.$request->TBK_ORDEN_COMPRA.'.']);

          //============ envio correo  ============//

          //saco los datos del cliente en el pedido.

          $mis_datos = DB::table('pedidos')
                ->select('ped_cli_nombre','ped_cli_calle','ped_cli_num','ped_cli_dpto', 'ped_cli_email','ped_cli_paterno','ped_cli_comuna','ped_despacho')
                ->where('ped_id', $request->TBK_ORDEN_COMPRA)
                ->first();
          DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE.saco los datos del cliente en el pedido. Ped_id:'.$request->TBK_ORDEN_COMPRA.'.']);

         $array['nombre']   = $mis_datos->ped_cli_nombre;
         $array['apellido'] = $mis_datos->ped_cli_paterno ;
         $array['comuna']   = $mis_datos->ped_cli_comuna;
         $array['calle']    = $mis_datos->ped_cli_calle;
         $array['numero']   = $mis_datos->ped_cli_num;
         $array['dpto']     = $mis_datos->ped_cli_dpto;
         $array['email']    = $mis_datos->ped_cli_email;
         $array['despacho']    = $mis_datos->ped_despacho;
         //con el subtotal.
         $array['ped']=$request->TBK_ORDEN_COMPRA;
         //item que compre.
         $mis_item = DB::select('select it.item_cantidad_pedida, it.item_precio_vta, it.item_nombre, vt.uni_foto,it.item_uni_id
                                from items it, unidades_ventas vt
                                where item_ped_id= '.$request->TBK_ORDEN_COMPRA.'
                                and it.item_uni_id = vt.uni_id');
            DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE.saco los item que enviare en el correo. Ped_id:'.$request->TBK_ID_SESION.'.']);

              $mensaje='';
              $sum_total = 0;
             foreach($mis_item as $i){
               $sum_total += $i->item_precio_vta * $i->item_cantidad_pedida;
                 $mensaje .= "
                <tr style='text-transform: uppercase;'>
                  <td style='text-align:left'><img src='http://www.bymaria.cl/bymaria/imagenes/univta/{$i->uni_foto}' height=50 width=50></td>
                 <td style='text-align:left'> {$i->item_nombre}</td>
                 <td style='text-align:center'>{$i->item_cantidad_pedida}</td>
                 <td style='text-align:center'>$";
                   $mensaje .= number_format($i->item_precio_vta * $i->item_cantidad_pedida,0,",",".");
                   $mensaje .= "</td>
                </tr>";
             }
              $array['items']=$mensaje;
              $array['total']=$sum_total;

              DB::table('eventos')->insert(['evento_texto' => 'WEBPAY CIERRE. Envio correo por proceso de compra completo. correo a:'.$array['email'].'.']);

              Mail::send('emails.nuevo_pedido_transferencia',  $array, function($message) use ($array){
                  $message->to('chermosilla@cecsoluciones.cl');
                   $message->cc($array['email']);
                  $message->from($array['email']);
                  $message->subject('Pedido ByMaria');
              });

          //============ ************  ============//

          //devuelvo el webpay con mensaje aceptado
          DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE. paso a vista aceptado. ped_id:'.$request->TBK_ORDEN_COMPRA.'.']);
          return view('webpayCierre')->with('mimensaje', 'ACEPTADO');
         }else{
           DB::table('log')->insert(['log_texto' => 'WEBPAY CIERRE. paso a vista RECHAZADO. ped_id:'.$request->TBK_ORDEN_COMPRA.'.']);

          return view('webpayCierre')->with('mimensaje', 'RECHAZADO');
         }

    }

}
