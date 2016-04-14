@extends('layouts.cabad')
@section('content')



<h1 class="page-header">Crear Productos</h1>
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <div class="panel panel-default">
    <div class="panel-body">
<div class="form-group">
{{ Form::open (['route'=>['productos.store'],'method'=>'POST','file'=>true,'novalidate' => 'novalidate','class'=>'form-horizontal']) }}
    <div class="form-group has-feedback ">
      <div class=" col-md-6">
        <label class="control-label">Foto</label>
          <div class="image-upload">
               <label for="pro_foto">
                 <img id="pro_foto_prin" class="foto_principal" src="http://placehold.it/250x250"/>
               </label>
               <input id="pro_foto" type="file" name="pro_foto"/>
           </div>
    </div>
        <div class="col-md-4">
          <label class="control-label">Nombre</label>
         {{ Form::text('pro_nombre', '', array('required','class'=>'form-control input-sm', 'placeholder'=>'Nombre del producto')) }}
             <i class="form-control-feedback fa fa-apple"></i>
           </div>
           <div class="col-md-4">
             <label class="control-label">Descripción</label>
            {{ Form::textarea('pro_descripcion', '', array('required','class'=>'form-control input-sm', 'placeholder'=>'Descripcion del producto')) }}
              <i class="form-control-feedback fa fa-align-justify"></i>
        </div>

     </div>
	{{ Form::button('<i class="fa fa-check">Guardar</i>', array('type'=>'submit','class' => 'btn btn-primary pull-left')) }}

   {{   Form::close()   }}
    </div>
  </div>
</div>


 @stop
