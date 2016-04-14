@extends('layouts.app')
@section('content')

<div class="panel panel-default">
  @include('layouts.msjes')
    <div class="panel-body">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

  <h1 class="page-header">Lista de Unidades Ventas</h1>
  <div class="form-group">

<div class="table-responsive">
            <table class="table table-striped table-condensed table-bordered">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Descripcion</th>
                  <th>Precio</th>
                  <th>Publica</th>
                  <th>Foto</th>
                  <th>Accion</th>
              </tr>
              </thead>
              <tbody>
                @foreach($univta as $item)
                <tr data-id="{{$item->uni_id}}">
                  <td class="edit-enabled">{{ $item->uni_nombre }}</td>
          		    <td class="edit-enabled">{{ $item->uni_descripcion }}</td>
                  <td class="edit-enabled">{{ $item->uni_precio }}</td>
                  <td class="edit-enabled">
                     @if($item->uni_publica==1)
                       {{ Form::checkbox('uni_publica', 0, null, ['class' => 'field', 'checked' =>'checked']) }}
                     @else
                      {{ Form::checkbox('uni_publica', 0, null, ['class' => 'field']) }}
                     @endif
                  </td>
                  <td class="edit-disabled">
                    	{!! Form::open (['role'=>'form']) !!}
                    <div class="image-upload">

                     <label for="uni_foto">
                        @if ($item->uni_foto=="")
                        <img id="uni_foto_prin" class="thumbnail img-responsive"  src="http://placehold.it/100x40" width="100" height="100"/>
                        @else
                        <img id="uni_foto_prin" class="thumbnail img-responsive"  src=" imagenes/univta/{{$item->uni_foto}}" width="100" height="100" alt="..">
                        @endif
                     </label>

                     <input id="uni_foto" type="file" name="uni_foto"/>

                     </div>
                     {!!   Form::close()   !!}
                  </td>
                  <td class="edit-disabled">
                    <a href= "#!" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    <a href= "#!" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
       </div>

      </div>
      </div>

      @include('layouts.modal')
  @endsection

    @section('scripts')
    <script type="text/javascript" src="{{ URL::asset('assets/js/editable-table-master/mindmup-editabletable.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/AjaxUniEdit.js') }}"></script>
    @endsection
