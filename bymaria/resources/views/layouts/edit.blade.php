@extends('layouts.cabad')
@section('content')


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

  {{-- $myplace--}}


  <h1 class="page-header">Producto {{$producto->pro_nombre}}</h1>
  <div class="col-md-8 col-md-offset-2">

    @include('admin.productos.form.editPro')
    @include('layouts.modal')

  </div>  
</div>

@endsection
