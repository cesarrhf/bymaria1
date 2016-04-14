

<div class="col-md-10 col-centered ">
  <div class="row text-center">
  @if(isset($listPro))
  @foreach($listPro as $item)
    <div class="col-sm-12 col-md-3 listaProductos ">
      <div class="some">
         <img class="img-responsive test trasera hide"  src="imagenes/productos/{{$item->pro_foto_trasera}}" alt="">
         <a href="#!"><img class="img-responsive test delantera"  src="imagenes/productos/{{$item->pro_foto}}" alt="">  </a>
      </div>
          <h4 style="margin-bottom: 0px;">{{$item->pro_nombre}}</h4>
          <p   style="margin-top: 10px;" > {{$item->pro_subtitulo}}    </p>
          <p   style="text-align: center"> <a href="#!" style="    color: red;"class="linkks">Ingredientes</a>    </p>
          <p class="text-justify descripcionProducto"> {{$item->pro_descripcion}}  </p>
          <p style="text-align:center;"><a href="tienda" class="btn btnIndex btn-primaryVenta " data-id="9">Comprar</a></p>
    </div>
  @endforeach
  @endif
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">INGREDIENTES</h4>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" class="img-responsive" >
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR</button>
      </div> -->
    </div>
  </div>
</div>
