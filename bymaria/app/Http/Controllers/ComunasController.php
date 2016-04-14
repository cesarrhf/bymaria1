<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use App\Models\Regiones;

class ComunasController extends Controller
{

    public function index()
    {
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function comunasxRegion($id){
      $comunas = DB::select('select *
                              from comunas c, provincias p, regiones r
                              where r.REGION_id="'.$id.'"
                              and r.REGION_ID = p.PROVINCIA_REGION_ID
                              and c.COMUNA_PROVINCIA_ID = p.PROVINCIA_ID');
      return json_encode($comunas);

    }

    public function comunasSelect(Request $request){

      $comunas = DB::select('select * from comunas');
      return json_encode($comunas);

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
