
@extends('layouts.app')

@section('content')

<div class="panel panel-default">

    <div class="panel-body">
      <h1 class="page-header">Crear Pedido</h1>

         {!! Form::open (['id'=>'formPed', 'class'=>'form-horizontal', 'role'=>'form']) !!}
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
      <div class="form-group">

        <div class="col-md-12">
          @section('form')
          <div class="col-md-5">
            @include('admin.pedidos.form.partials.formDespacho')
            @include('admin.pedidos.form.partials.formCli')

        </div>
          <div class="col-md-7">
            @include('admin.pedidos.form.partials.table')
            @include('admin.pedidos.form.partials.formPed')

          </div>
           @show
        </div>
    </div>
               {!!link_to('#', $title='Registrar', $attributes = ['id'=>'registro', 'class'=>'btn btn-primary'], $secure = null)!!}
               {!!   Form::close()   !!}


    </div>
  </div>

@endsection
@section('scripts')
{{--js de ajax --}}
<script src="{{ asset('assets/js/bootstrap-select/dist/js/bootstrap-select.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="{{ URL::asset('assets/js/AjaxPedidos.js') }}"></script>
@endsection
