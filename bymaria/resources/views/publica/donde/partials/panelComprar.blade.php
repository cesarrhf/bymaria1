<div class="panel-body panel-donde">
  <div class="">
    {!! Form::open([ 'id'=>'formDonde', 'method' => 'POST','class'=>'']) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">


      @if(isset($listPro))
      @foreach($listPro as $item)
      <div class="form-group">
       <div class="radio">
         <input  id="radioP{{$item->pro_id}}" name="name[]" type="radio" value="{{$item->pro_id}}">
         <label for="radioP{{$item->pro_id}}">
                 <span class="fa-stack">
                     <i class="fa fa-circle-o fa-stack-1x"></i>
                     <i class="fa fa-circle fa-stack-1x"></i>
                 </span>
                 {{$item->pro_nombre}}
             </label>
        </div>
     </div>
  @endforeach
  @endif
</div>
  <div class="">
    <h6 class="text-center" >REGIóN</h6>
    <select class="selectpickerRegionComprar" data-live-search="true" title=" "  >
      @if(isset($region))
      @foreach($region as $item)
      <option value="{{ $item->region_id}}"  >{{ $item->region_nombre}} </option>
      @endforeach
      @endif
    </select>
</div>

<div class="">
  <h6 class="text-center" >COMUNA</h6>
  <select name="txtComu" id="txtComu"  class="selectpickerComunaComprar" data-live-search="true" >
  </select>
</div>
<div class="text-center miMensjeDonde2">
 {!! Form::submit('Buscar', ['class'=>'btn btnDonde btn-primaryVenta'] ) !!}

{{ Form::close() }}
<p class="mensajes hide">Pronto estaremos en este lugar</p>

</div>

</div>
