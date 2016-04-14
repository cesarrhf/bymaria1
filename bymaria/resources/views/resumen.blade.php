@extends('layouts.cab')
@section('content')

{!! Html::script('assets/js/AjaxTienda.js') !!}
<div class="col-xs-11  col-sm-10 col-centered idDiv">
  @include('publica.tienda.partials.resumenTable')
  @include('publica.tienda.partials.form')

</div>
@endsection
