<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Pedidos;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;

class ItemsController extends Controller
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

    // public function Grafico(Request $request){
    //   fechaProducto
    // }

    public function Grafico(Request $request){
        // dd($request->all());
        $array        = array();
        $array2       = array();
        $array3       = array();
        $hoy          = date("Y-m-d");
        $fechaFinal   = $request->endDate;

        if ($request->endDate==$hoy) {
          $fechaFinal = date("Y-m-d H:i:s");
         }
      $ventas_mes     = DB::select(' select   WEEK(ped_fecha,1) as semana,pro_id,sum(if(uni_custom = 2,1, (uni_cantidad_present))) as suma, pro_nombre
                                      from pedidos ped, items it, productos pro, unidades_ventas vt, present_uni_ventas pvt, presentaciones pt
                                      where  ped.ped_estado_pago = "pagado"
                                      and ped.ped_id             = it.item_ped_id
                                      and it.item_uni_id         = vt.uni_id
                                      and vt.uni_id              = pvt.univ_un_id
                                      and pvt.univ_pres_id       = pt.pres_id
                                      and pt.pres_id_pro         = pro.pro_id
                                      and ped.ped_fecha BETWEEN  "'.$request->startDate.'" and  "'.$fechaFinal.'"
                                      group by  semana,pro_id,pro_nombre;');
    // dd($ventas_mes);
      // { y: 'semana 1', a: 100, b: 90,c: 60,d:70 },
       $test= -1;
       $k=0;
       foreach($ventas_mes as $i){

         if ($test==-1) {
           $test = $i->semana;
         }if ($i->semana != $test  ){
           $test = $i->semana;
          //  $array = array_combine($array2, $array3);

          //  $array[$k] = $array2;
          //  $array2 = array();
          //  $array3 = array();
          //  $k++;
         }if ($i->semana == $test ) {
            //  $temp= (string)$i->pro_id.:.(string)$i->suma;
          array_push($array2 , $i->semana.':'.$i->suma.':'.$i->pro_id.':'.$i->pro_nombre  );

         }
       }
      //  $array[$k] = $array2;
  // $array = array_merge($array2, $array3);
       return response()->json($array2);

    }

     //item agregado desde la bd
    public function store(Request $request)
    {
    //  dd($request->all());
      if ($request->ajax()) {
          $items = new Items();
          $items->item_ped_id = $request->item_ped_id;
          $items->item_uni_id = $request->item_uni_id;
          $items->item_cantidad_pedida = $request->item_cantidad_pedida;
          $items->item_precio_vta = $request->item_precio_vta;
          $items->item_nombre = $request->item_nombre;
          $items->save();
          DB::table('log')->insert(['log_texto' => 'Guardo en Items. Id:'.$items->item_id.'.']);

          return response()->json([
            'mensaje' => 'Insertado'
        ]);
      }
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
}
