<div class="col-xs-12 col-sm-6       ">
  <div class="col-sm-12 bordeResumen">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

<div class="row text-left miMargenDatos datosCli ">
  <h6>confirmación de compra</h6>
  <br>
  <p id="nombreCompleto" data-nombre="{{$request->ped_cli_nombre}}" data-apellido="{{$request->ped_cli_paterno}}" > {{$request->ped_cli_nombre}} {{ $request->ped_cli_paterno}}</p>
  <p id="direccionCompleta" data-calle="{{$request->ped_cli_calle}}" data-numero="{{$request->ped_cli_num}}" data-dpto="{{$request->ped_cli_dpto}}"> {{$request->ped_cli_calle }} {{$request->ped_cli_num }} {{$request->ped_cli_dpto}}</p>
  <p id="comunaPedido" data-coordenadas="{{$request->coordenadas}}" data-comuna ="{{$request->txtComu}}"> {{$request->txtComu}}</p>
  <p id="telefonoPed" data-telefono= "{{$request->ped_cli_celular}}"> Teléfono: {{$request->ped_cli_celular}}</p>
  <p id="emailPed" data-email="{{$request->ped_cli_email}}"> {{$request->ped_cli_email}}</p>

  <br>
  <p> Fecha de entrega dentro de los 7 dias habiles.</p>
<hr>
   <div class="col-sm-6 text-left sinPading">
    <h6>TOTAL COMPRA</h6>
  </div>
  <div class="col-sm-6 text-right">

  <h6 id="miTotalFinal" data-hash={{$hash}} data-id="{{$request->ped_subtotal}}">${{ number_format((int)$request->ped_subtotal+(int)$precio, 0, '', '.') }}</p>
  </div>
  <br>
  <hr>

<h6>MÉTODO DE PAGO</h6>
  <div class="col-sm-12 sinPading">
    <input  id="radio1" name="uni_publica" type="radio" value="0" checked>
    <label for="radio1">
            <span class="fa-stack">
                <i class="fa fa-circle-o fa-stack-1x"></i>
                <i class="fa fa-circle fa-stack-1x"></i>
            </span>
            WEBPAY
     </label>

  </div>
  <div class="col-sm-12 sinPading">
    <input  id="radio2" name="uni_publica" type="radio" value="1">
    <label for="radio2">
            <span class="fa-stack">
                <i class="fa fa-circle-o fa-stack-1x"></i>
                <i class="fa fa-circle fa-stack-1x"></i>
            </span>
            TRANSFERENCIA
     </label>

  </div>

  <div class="col-sm-12 text-center center-block" style="padding-top:10px">
    {!!link_to('#', $title='continuar', $attributes = ['id'=>'registro', 'class'=>'btn btn-primaryContac'], $secure = null)!!}
  </div>
  <div class="hide">
    <form id="f_webpay" action="../cgi-bin/tbk_bp_pago.cgi" method="POST">
      <input class="campo" type="text" name="TBK_TIPO_TRANSACCION" value="TR_NORMAL">
      <input class="campo" type="text" name="TBK_MONTO">
      <input class="campo" type="text" name="TBK_ORDEN_COMPRA">
      <input class="campo" type="text" name="TBK_ID_SESION">
      <input class="campo" type="text" name="TBK_URL_EXITO" value="http://www.bymaria.cl/bymaria/webpayExito">
      <input class="campo" type="text" name="TBK_URL_FRACASO" value="http://www.bymaria.cl/bymaria/webpayFracaso">
    </form>
  </div>
<br>

</div>
</div>
</div>
