<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
USE DB;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        $list_productos = db::table('productos')->select('pro_id', 'pro_nombre')->get();
        // $ventas_mes     = DB::select('select sum(pro_id) as suma , pro_id
        //                               from pedidos ped, items it, productos pro, unidades_ventas vt, present_uni_ventas pvt, presentaciones pt
        //                               where  ped.ped_estado_pago="pagado"
        //                               and ped.ped_id = it.item_ped_id
        //                               and it.item_uni_id = vt.uni_id
        //                               and vt.uni_id = pvt.univ_un_id
        //                               and pvt.univ_pres_id = pt.pres_id
        //                               and pt.pres_id_pro = pro.pro_id
        //                               and  ped.ped_fecha BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()
        //                               group by pro_id;');
        // dd($list_productos);

        //hago la suma con el if de mysql directo en la comnsulta. OJO!! ademas es el total mensual!!.
        $ventas_mes     = DB::select('select  uni_id, uni_custom, uni_cantidad_present,pro_id, sum(if(uni_custom = 2,1, (uni_cantidad_present))) as suma
                                      from pedidos ped, items it, productos pro, unidades_ventas vt, present_uni_ventas pvt, presentaciones pt
                                      where  ped.ped_estado_pago="pagado"
                                      and ped.ped_id = it.item_ped_id
                                      and it.item_uni_id = vt.uni_id
                                      and vt.uni_id = pvt.univ_un_id
                                      and pvt.univ_pres_id = pt.pres_id
                                      and pt.pres_id_pro = pro.pro_id
                                      and  ped.ped_fecha BETWEEN NOW() - INTERVAL 30 DAY AND NOW()
                                      group by (pro_id);');

        return view('admin.inicio')->with('list_productos', $list_productos)->with('ventas_mes', $ventas_mes);
    }
}
