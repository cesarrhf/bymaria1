  @if(isset($datosComprador))
  <div class="col-xs-12 col-sm-5 col-lg-5 col-sm-pull-7   sinPading sinPadingRight col-centered divInfo ">
  @else
  <div class="col-xs-12 col-sm-5 col-lg-5     col-centered divInfo ">
  @endif
     <div class="col-xs-12 col-sm-12 bordeResumen">
       @if(isset($datosComprador))
       <h6>Contacto Despacho</h6>
          <p>Nº PEDIDO #{{$datosComprador['ped'] }}.</p>
          <p>{{$datosComprador['nombre']}} {{$datosComprador['apellido']}}.</p>
          <p>{{$datosComprador['calle']}} {{$datosComprador['numero']}}   {{$datosComprador['dpto']}}.</p>
          <p>{{$datosComprador['comuna']}}.</p>
          <p>{{$datosComprador['email']}}.</p>
       @else
       <h6>transferencias bancarias</h6>
       <p>Si prefieres pagar mediante transferencia bancaria debes enviar el comprobante de transferencia a:indicando el número de pedido.</p>
         <p>BANCO:</p>
         <p>TIPO CUENTA: Cuenta Corriente.</p>
         <p>NºCUENTA: 1231233123.</p>
         <p>RUT:12.123.123-4</p>
         <p>EMAIL: pedidos@asd.cl</p>
       @endif
 </div>
</div>
