
@extends('layouts.cab')
@section('content')


<!-- {!! Html::script('assets/js/AjaxTienda.js') !!} -->

<div class="col-xs-12  col-sm-12 col-centered">

<h6 style="text-align:center; font-size:1.2em;">¡EXCELENTE! TU PEDIDO FUE UN ÉXITO</h6>

 @include('publica.tienda.partials.resumenTable')
 @include('publica.tienda.partials.informacion')
</div>
@endsection
