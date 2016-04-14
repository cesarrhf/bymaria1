<div class="col-xs-12 col-sm-6 col-md-7">
 <div class="row text-center">
  @if(isset($listPro))
  @foreach($listPro as $item)
    @if($item->uni_id == 373)
    <div class="col-sm-6 listaProductos2  ">
               <img data-id="{{$item->uni_precio}}" name="{{$item->uni_nombre}}" class="img-responsive"  src="imagenes/univta/{{$item->uni_foto}}" alt="">
              <h4 style="margin-bottom: 6px;">{{$item->uni_nombre}}</h4>
              <div class="descripcion">
                <p class="text-justify"> {{$item->uni_descripcion}} </p>
              </div>
              <div class="precioss">
                <p  class="text-center">.-</p>
              </div>
            {!!link_to('#', $title='Contactar', $attributes = [ 'id'=>'regaloCorp','data-id'=>$item->uni_id, 'class'=>'btn btnTienda btn-primaryVenta '], $secure = null)!!}
      </div>
    @else
    <div class="col-sm-6 listaProductos2  ">
              <img data-id="{{$item->uni_precio}}" name="{{$item->uni_nombre}}" class="img-responsive"  src="imagenes/univta/{{$item->uni_foto}}" alt="">
              <h4 style="margin-bottom: 6px;">{{$item->uni_nombre}}</h4>
              <div class="descripcion">
                <p class="text-justify"> {{$item->uni_descripcion}} </p>
              </div>
              <div class="precioss" data-custom="{{$item->uni_custom}}" data-cant="{{$item->uni_cantidad_present}}">
                <p  class="text-center">{{$item->uni_precio}} </p>
              </div>
            {!!link_to('#', $title='Agregar', $attributes = [ 'id'=>'btn'.$item->uni_id, 'value'=>$item->uni_id,'class'=>'btn btnTienda btn-primaryVenta ','data-id'=>$item->uni_id,'data-padre'=>$item->uni_custom], $secure = null)!!}
      </div>
      @endif
  @endforeach
  @endif
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="contactoCorp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Regalos corporativos</h4>
      </div>
      <div class="modal-body">
        @include('publica.tienda.partials.formModal')
        </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button> -->
        {!! Form::submit('Enviar', ['class'=>'btn btnContacto btn-primaryContac', 'id'=>'btnContacModal'] ) !!}
        {!! Form::close() !!}

      </div>
    </div>
  </div>
</div>
