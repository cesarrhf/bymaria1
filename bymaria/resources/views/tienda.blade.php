@extends('layouts.cab')

@section('content')


<!-- Scripts -->
<script type="text/javascript" src="https://maps.google.com/maps/api/js"></script>

{!! Html::script('assets/js/mapaTienda.js') !!}

{!! Html::script('assets/js/AjaxTienda.js') !!}
{!! Html::script('assets/js/bootstrap-select/dist/js/bootstrap-select.js') !!}
<link rel="stylesheet" href="{{ URL::asset('assets/js/bootstrap-select/dist/css/bootstrap-select.css') }}" />

<div class="col-xs-12  col-sm-12 col-lg-10 col-centered">

@include('publica.tienda.partials.products')

@include('publica.tienda.partials.tabla')



</div>



@endsection
