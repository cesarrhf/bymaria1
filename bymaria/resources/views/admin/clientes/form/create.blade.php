
@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-body">
      <h1 class="page-header">Crear Cliente</h1>

      @include('layouts.msjes')
      @include('admin.clientes.form.partials.cliForm')
      <div class="col-md-12 myMapa hide">
        <input type="text" name="coordenadas" value="" class="hide">
            <div class="text-center" id="resultado"></div>
            <div class="msjeConfirma text-center hide">
              <p>  CONFIRME SU DIRECCION  </p>
            </div>
            <div class="col-md-12 form-group">
              <div style="height:300px;" class="mapaDire" id="mapa"></div>
            </div>
            <div class="confirmar form-group  text-center hide">
              {!!link_to('', $title='CONFIRMAR', $attributes = ['id'=>'btnConfirma', 'class'=>'btn btn-warning'], $secure = null)!!}
              <a href="#"   class="btn btn-primaryContac no-activo hide btnConfi" style="pointer-events: none;cursor: default;">CONFIRMADO</a>
            </div>
            <div class="alert alert-danger hide">
               <p>!NO CONFIRMÓ DIRECCIÓN!  Debe confirmar direccion para continuar.</p>
            </div>
      </div>
      @include('admin.clientes.form.partials.contacFormTable')

    </div>
  </div>

@endsection
@section('scripts')
{{--js de ajax --}}
 <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
 <script type="text/javascript" src="{{ URL::asset('assets/js/editable-table-master/mindmup-editabletable.js') }}"></script>
 <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript" src="{{ URL::asset('assets/js/mapaAdminCli.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/AjaxClientes.js') }}"></script>




@endsection
