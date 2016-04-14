@extends('layouts.app')
@section('content')

  @include('layouts.msjes')
<div class="panel panel-default">
<div class="panel-body">
  <h1 class="page-header">Crear Productos</h1>

<div class="form-group">
{!! Form::open (['file'=>true,'novalidate' => 'novalidate','class'=>'form-horizontal']) !!}
  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <div class="form-group has-feedback ">
      <div class=" col-xs-12 col-md-4 col-lg-3">
        <label class="control-label">Foto Principal</label>
          <div class="image-upload">
               <label for="pro_foto">
                 <img id="pro_foto_prin" class="img-responsive" src="http://placehold.it/250x250"/>
               </label>
               <input id="pro_foto" type="file" name="Foto Principal"/>
           </div>
           <label class="control-label">Foto Trasera</label>
             <div class="image-upload">
                  <label for="pro_foto_trasera">
                     <img id="pro_foto_tras" class="img-responsive" src="http://placehold.it/250x250"/>
                   </label>
                  <input id="pro_foto_trasera" type="file" name="Foto Trasera"/>
              </div>
    </div>
    <div class=" col-xs-12 col-sm-8 col-md-8 col-lg-6">

      <div class="col-xs-12 col-md-12 col-lg-12 sinPading">
          <label class="control-label">Nombre</label>
         {{ Form::text('pro_nombre', '', array('required','class'=>'form-control input-sm', 'placeholder'=>'Nombre del producto')) }}
             <i class="form-control-feedback fa fa-apple"></i>
           </div>
           <div class="col-xs-12 col-md-12 col-lg-12 sinPading">
             <label class="control-label">Descripción</label>
            {{ Form::textarea('pro_descripcion', '', array('required','class'=>'form-control input-sm', 'placeholder'=>'Descripcion del producto')) }}
              <i class="form-control-feedback fa fa-align-justify"></i>
        </div>
      </div>

     </div>
     {!!link_to('#', $title='Registrar', $attributes = ['id'=>'registro', 'class'=>'btn btn-primary'], $secure = null)!!}

	{{-- Form::button('<i class="fa fa-check">Guardar</i>', array('type'=>'submit','class' => 'btn btn-primary pull-left')) --}}

   {!!   Form::close()   !!}
    </div>
  </div>
</div>

@endsection
@section('scripts')
{{--js de ajax --}}
<script type="text/javascript" src="{{ URL::asset('assets/js/AjaxCreatePro.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/globales.js') }}"></script>
	@endsection
