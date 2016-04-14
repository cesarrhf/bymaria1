<div class="panel-body panel-donde">
  <div class=" ">
    {!! Form::open([ 'id'=>'formComer', 'method' => 'POST','class'=>'']) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
</div>
  <div class="">
    <h6 class="text-center">REGIÓN</h6>
    <select class="selectpickerRegionComprar2" data-live-search="true" title=" " >
      @if(isset($region))
      @foreach($region as $item)
      <option value="{{ $item->region_id}}"  >{{ $item->region_nombre}} </option>
      @endforeach
      @endif
    </select>
  </div>
<div class="">
  <h6 class="text-center">COMUNA</h6>
  <select name="txtComu2" id="txtComu2"  class="selectpickerComunaComprar2" data-live-search="true" >
  </select>
</div>
<div class="miMensjeDonde text-center">
 {!! Form::submit('Buscar', ['class'=>'btn btnDonde btn-primaryVenta'] ) !!}
{{ Form::close() }}
<p class="mensajes hide">Pronto estaremos en este lugar</p>

</div>
</div>
