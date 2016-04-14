@extends('layouts.app')
@section('content')

<div class="panel panel-default">
  @include('layouts.msjes')
<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <div class="panel-body">
  <h1 class="page-header">Lista de Pedidos</h1>
  <div class="form-group">
<div class="table-responsive">
            <table class="table table-striped table-condensed table-bordered">
              <thead>
                <tr>
                  <!-- <th>Estado</th> -->
                  <th>Cliente</th>
                  <th>Nombre Contacto</th>
                  <th>Apellido Contacto</th>
                  <th>Fecha Pedido</th>
                  <th>Fecha Despacho</th>
                  <th>Comuna</th>
                  <th>Calle</th>
                  <th>Numero</th>
                  <th>Dpto</th>
                  <th>Telefono</th>
                  <th>Observacion</th>
                  <th>Neto</th>
                  <th>Total</th>
              </tr>
              </thead>
              <tbody>
                @foreach($ped as $item)
              <tr data-id="{{$item->cli_id}}">
                  <td class="edit-enabled">{{ $item->ped_id_cliente }}</td>
                  <td class="edit-enabled">{{ $item->ped_cli_nombre }}</td>
          		    <td class="edit-enabled">{{ $item->ped_cli_paterno }}</td>
                  <td class="edit-enabled">{{ $item->ped_fecha }}</td>
                  <td class="edit-enabled">{{ $item->ped_fecha_despacho }}</td>
                  <td class="edit-enabled">{{ $item->ped_cli_comuna }}</td>
                  <td class="edit-enabled">{{ $item->ped_cli_calle }}</td>
                  <td class="edit-enabled">{{ $item->ped_cli_num }}</td>
                  <td class="edit-enabled">{{ $item->ped_cli_dpto }}</td>
                  <td class="edit-enabled">{{ $item->ped_cli_celular }}</td>
                  <td class="edit-enabled">{{ $item->ped_obs_pedido }}</td>
                  <td class="edit-enabled">{{ $item->ped_neto }}</td>
                  <td class="edit-enabled">{{ $item->ped_total }}</td>



                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>

      </div>
      </div>


    @stop
    @section('scripts')
    <script type="text/javascript" src="{{ URL::asset('assets/js/editable-table-master/mindmup-editabletable.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/AjaxClientes.js') }}"></script>
    @endsection
