
<div class="form-group">
 <h4>Unidades de Ventas</h4>



   <div class="row">
        @foreach($uniVta as $item)
         <div class="col-lg-2 col-sm-3 col-xs-4">
            <strong>{{ $item->pres_nombre }}</strong>
              <a  href="#">
               @if ($item->uni_foto=="")
               <img name="{{ $item->uni_nombre }}" id="{{ $item->uni_id }}" class="thumbnail img-responsive" src="http://placehold.it/70x45"/>
               @else

                 <img name="{{ $item->uni_nombre }}" id="{{ $item->uni_id }}" class="thumbnail img-responsive" src="../../imagenes/univta/{{$item->uni_foto}}"/>


       
                  @endif
                </a>
                  </div>
            @endforeach

     </div>
   </div>
