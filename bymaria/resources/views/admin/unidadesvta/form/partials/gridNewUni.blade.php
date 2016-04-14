<div class=" col-sm-12  form-group" >
 <h4 class="text-center">Presentaciones</h4>
   <div class="row">
        @foreach($present as $item)
         <div class="col-lg-3 col-sm-3 col-xs-6">
            <strong>{{ $item->pres_nombre }}</strong>
              <a  href="#">
               @if ($item->pres_foto=="")
               <img name="{{ $item->pres_nombre }}" id="{{ $item->pres_id }}" class="thumbnail img-responsive altoAdmin" src="http://placehold.it/100x95"/>
               @else
                 <img name="{{ $item->pres_nombre }}" id="{{ $item->pres_id }}" class="thumbnail img-responsive altoAdmin" src="../imagenes/presentaciones/{{$item->pres_foto}}"/>
                @endif
                </a>
                  </div>
            @endforeach

     </div>
   </div>
