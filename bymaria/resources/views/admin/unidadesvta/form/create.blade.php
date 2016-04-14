
@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body">
      <h1 class="page-header">Crear Unidades de Ventas</h1>

      @include('layouts.msjes')
        {!! Form::open (['class'=>'form-horizontal', 'role'=>'form']) !!}
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
      <div class="form-group">
      <div class="col-sm-5 col-md-6 col-lg-4">
          <div class="form-group ">
                    <div class="col-md-8 col-lg-12">
                      <div class="image-upload">
                           <label for="uni_foto">
                             <img id="uni_foto_prin" class="img-responsive" src="http://placehold.it/250x250"/>
                           </label>
                           <input id="uni_foto" type="file" name="uni_foto"/>
                       </div>
                </div>
              </div>
                  <div class="  has-feedback">
                      <div class="form-group ">
                                  <div class="col-md-10">
                              {{--  <label class="control-label">Nombre</label>--}}
                                {{ Form::text('uni_nombre','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Nombre')) }}
                                <i class="form-control-feedback fa fa-apple"></i>
                              </div>
                    </div>
                    <div class="form-group">
                                  <div class="col-md-10">
                                  {{--  <label class="control-label">Precio</label>--}}
                                    {{ Form::text('uni_precio','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Precio')) }}
                                    <i class="form-control-feedback fa fa-apple"></i>
                                  </div>
                                </div>
                      <div class="form-group">
                              <div class="col-md-10">
                                {{--<label class="control-label">Descripción</label>--}}
                               {{ Form::textarea('uni_descripcion','', array('required','class'=>'form-control input-sm', 'placeholder'=>'Descripcion','rows'=>'2')) }}
                                 <i class="form-control-feedback fa fa-align-justify"></i>
                               </div>
                      </div>
                      <div id='miPack' class="form-group ">
                            <div class="col-md-10">
                              {{ Form::text('uni_cantidad_present','', array('required','class'=>'form-control input-sm','id'=>'uni_cantidad_present','placeholder'=>'Cantidad de Productos')) }}

                              </div>
                      </div>
                    </div>
                    <div class="form-group ">
                          <div class="col-md-10">
                            {{ Form::label('name', 'Publico', array('class' => 'control-label')) }}  {{ Form::checkbox('uni_publica', 0, null, ['class' => 'field','checked' =>'checked']) }}
                           {{ Form::label('name2', 'Armable', array('class' => 'control-label')) }}  {{ Form::checkbox('uni_custom', 0, null, ['class' => 'field', 'id'=>'uni_custom']) }}
                         </div>
                    </div>

            </div>
                {{-- aqui el include de la tabla. --}}
                  @section('table')
                   @include('admin.unidadesvta.form.partials.table')
                  @show
              </div>
               {!!link_to('#', $title='Registrar', $attributes = ['id'=>'registro', 'class'=>'btn btn-primary'], $secure = null)!!}
               {!!   Form::close()   !!}

                @section('gridImg')
                 @include('admin.unidadesvta.form.partials.gridNewUni')
                @show
    </div>
  </div>

@endsection
@section('scripts')
{{--js de ajax --}}
<script type="text/javascript" src="{{ URL::asset('assets/js/AjaxUniVta.js') }}"></script>
@endsection
