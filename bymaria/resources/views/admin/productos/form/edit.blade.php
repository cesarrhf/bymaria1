@extends('layouts.app')
@section('content')

<div class="panel panel-default">
    <div class="panel-body">
      <h1 class="page-header">Editar Productos</h1>

      <div class="form-group">
      {{ Form::open (['route'=>['productos.upImgPro',$producto->pro_id],'method'=>'PUT','id'=>'form-upImgPro','file'=>true,'novalidate' => 'novalidate','class'=>'form-horizontal', 'role'=>'form']) }}

          <div class="form-group has-feedback ">
            <div class=" col-xs-12 col-md-4 col-lg-3">
              <label class="control-label">Foto Delantera</label>
                <div class="image-upload">
                     <label for="pro_foto">
                       @if ($producto->pro_foto=="")
                       <img id="pro_foto_prin" class="img-responsive" src="http://placehold.it/250x250"/>
                       @else
                       <img id="pro_foto_prin" class="img-responsive" src="../../imagenes/productos/{{$producto->pro_foto}}"/>
                       @endif
                     </label>
                     <input id="pro_foto" type="file" name="pro_foto"/>
                 </div>
                 <label class="control-label">Foto Trasera</label>
                   <div class="image-upload">
                        <label for="pro_foto_trasera">
                          @if ($producto->pro_foto=="")
                          <img id="pro_foto_tras" class="img-responsive" src="http://placehold.it/250x250"/>
                          @else
                          <img id="pro_foto_tras" class="img-responsive" src="../../imagenes/productos/{{$producto->pro_foto_trasera}}"/>
                          @endif
                        </label>
                        <input id="pro_foto_trasera" type="file" name="pro_foto_trasera"/>
                    </div>

          </div>
          <div class=" col-xs-12 col-sm-8 col-md-8 col-lg-6">
            <div class="col-xs-12 col-md-12 col-lg-12 sinPading">
              <label class="control-label">Nombre</label>
             {{ Form::text('pro_nombre', $producto->pro_nombre, array('required','class'=>'form-control input-sm', 'placeholder'=>'Nombre del producto')) }}
                 <i class="form-control-feedback fa fa-apple"></i>
            </div>
               <div class="col-xs-12 col-md-12 col-lg-12 sinPading">
                 <label class="control-label">Descripción</label>
                {{ Form::textarea('pro_descripcion', $producto->pro_descripcion, array('required','class'=>'form-control input-sm', 'placeholder'=>'Descripcion del producto')) }}
                  <i class="form-control-feedback fa fa-align-justify"></i>
            </div>
          </div>
          </div>

         {{   Form::close()   }}
          </div>


      <div class="form-group">
       <h1>Presentaciones</h1> 	 {{ Form::button('<i class="fa fa-plus fa-fw"></i>', array('class' => 'btn btn-primary', 'id'=>'btnAgrePres')) }}

           <div class="table-responsive">
             {{ Form::hidden('invisible', $producto->pro_id, array('id' =>'pro_secret' )) }}
                       <table class="table table-striped">
                         <thead>
                           <tr>
                             <th>Nombre <i class="fa fa-copyright"></i></th>
                             <th>Foto <i class="fa fa-picture-o"></i></th>
                             <th>Acciones <i class="fa fa-hand-rock-o"></i></th>
                           </tr>
                         </thead>
                         <tbody>
                           @foreach($present as $item)
                           <tr data-id="{{$item->pres_id}}">
                              <td class="edit-enabled" >{{ $item->pres_nombre }}</td>
                              <td class="edit-disabled image-mini"  >{{-- $item->pres_foto --}}

                                       @if ($item->pres_foto=="")
                                       <img data-toggle="modal" data-target="#myModal" id="pres_foto_prin" class="foto_min_lista" src="http://placehold.it/50x50"/>
                                       @else
                                         <img data-toggle="modal" data-target="#myModal" id="pres_foto_prin" class="foto_min_lista" src="../../imagenes/presentaciones/{{$item->pres_foto}}"/>
                                        @endif

                              </td>
                              <td class="edit-disabled">
                               {{-- <a data-toggle="modal" data-target="#myModal" class="btn btn-info">Editar</a> --}}
                                <a href= "#!" class="btn btn-danger"> <i class="fa fa-times"></i></a>
                             </td>
                           </tr>
                           @endforeach
                         </tbody>
                       </table>
                     </div>
                  </div>
                  @include('layouts.modal')

    </div>

    {{-- ESTE FORM ES PARA LA ELIMINACION PRESENTACION --}}
    {{ Form::open (['route'=>['present.destroy', ':USER_ID'],'method'=>'DELETE','id'=>'form-delete']) }}
    {{   Form::close()   }}

    {{-- ESTE FORM ES PARA LA EDICION PRESENTACION  --}}
    {{ Form::open (['route'=>['present.edit', ':USER_ID'],'method'=>'PUT','id'=>'form-update' ]) }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    {{   Form::close()   }}
  </div>

@endsection
@section('scripts')
{{--js de la tabla editable --}}
<script type="text/javascript" src="{{ URL::asset('assets/js/editable-table-master/mindmup-editabletable.js') }}"></script>
{{--js de ajax --}}
<script type="text/javascript" src="{{ URL::asset('assets/js/AjaxPro.js') }}"></script>

	@endsection
