@extends('layouts.app')
@section('content')

<div class="panel panel-default">
    <div class="panel-body">
      <h1 class="page-header">Nueva Zona de despacho</h1>
      @include('layouts.msjes')
      <div class="form-group">
        <div id='map'  style="height:400px; "></div>
      </div>
      <div class="form-group">
          {!!link_to('#', $title='Nueva Zona', $attributes = ['id'=>'nuevaZona', 'class'=>'btn btn-primary'], $secure = null)!!}
     </div>
      {!! Form::open (['class'=>'form-horizontal', 'role'=>'form']) !!}
      <div id="myform" class="form-group hide">
       <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="  has-feedback">
            <div class="form-group ">
                <div class="col-sm-5 col-md-5 col-lg-10">
                    {{ Form::text('Nombre','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Nombre', 'id'=>'zoneNombre')) }}
                    <i class="form-control-feedback fa fa-apple"></i>
                </div>
            </div>
          <div class="form-group">
              <div class="col-sm-5 col-md-5 col-lg-10">
                 {{ Form::text('Precio','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Precio','id'=>'zonePrecio')) }}
                <i class="form-control-feedback fa fa-apple"></i>
              </div>
          </div>
       </div>
       {!!link_to('#', $title='Registro', $attributes = ['id'=>'registro', 'class'=>'btn btn-primary hide  '], $secure = null)!!}
       {!!link_to('#', $title='Actualizar', $attributes = ['id'=>'actualizar', 'class'=>'btn btn-primary'], $secure = null)!!}
       {!!link_to('#', $title='Borrar', $attributes = ['id'=>'borrar', 'class'=>'btn btn-primary'], $secure = null)!!}
       {!!link_to('#', $title='Cancelar', $attributes = ['id'=>'cancelar', 'class'=>'btn btn-primary'], $secure = null)!!}
      </div>
    </div>
    {!!   Form::close()   !!}
    </div>
  </div>

@endsection
@section('scripts')
{{--js de ajax --}}
<script type="text/javascript" src="{{ URL::asset('assets/js/ajaxDespacho.js') }}"></script>
<script type="text/javascript" src="https://maps.google.com/maps/api/js"></script>

@endsection
