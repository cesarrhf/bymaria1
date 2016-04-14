@extends('layouts.app')
@section('content')

<div class="panel panel-default ">
  @include('layouts.msjes')
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
<div class="panel-body">
  <h1 class="page-header">Lista de Clientes</h1>
<div class="form-group">
  <div class="form-group">
      <a href= "{{ URL::to('createCli') }}" class="btn btn-warning"><i class="fa fa-plus"></i> Agregar Cliente </a>
  </div>

<div class="table-responsive">
            <table id="tableClientes" class="table table-striped table-condensed table-bordered">
              <thead>
                <tr>
                  <th>Rut</th>
                  <th>Razon</th>
                  <th>Clave</th>
                  <th>Telefono</th>
                  <th>Correo</th>
                  <th>Acción</th>
              </tr>
              </thead>



              <tbody class="idDiv">
                @section('test')
                @foreach($cli as $item)
              <tr data-id="{{$item->cli_id}}">
                  <td class="edit-enabled">{{ $item->cli_rut }}</td>
                  <td class="edit-enabled">{{ $item->cli_razon }}</td>
                  <td class="edit-enabled">{{ $item->cli_clave }}</td>
                  <td class="edit-enabled">{{ $item->cli_telefono }}</td>
                  <td class="edit-enabled">{{ $item->cli_correo }}</td>
                  <td class="edit-disabled">
                  <a href= "#!" class="hide btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                  <a href= "#!" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                  </td>
              </tr>
                @endforeach
                @show
              </tbody>
            </table>
          </div>
        </div>

      </div>
      </div>

@include('layouts.modal')

     @stop

    @section('scripts')

    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/editable-table-master/mindmup-editabletable.js') }}"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

   <script type="text/javascript" src="{{ URL::asset('assets/js/mapaAdminCli.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/AjaxClientes.js') }}"></script>

    @endsection
