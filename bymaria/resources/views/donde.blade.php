@extends('layouts.cab')

@section('content')


<!-- Scripts -->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

{!! Html::script('assets/js/mapa.js') !!}

{!! Html::script('assets/js/ajaxDonde.js') !!}
{!! Html::script('assets/js/bootstrap-select/dist/js/bootstrap-select.js') !!}
<link rel="stylesheet" href="{{ URL::asset('assets/js/bootstrap-select/dist/css/bootstrap-select.css') }}" />




@include('publica.donde.partials.mapa')

<div class="subtitulo">
  <h2 class="titulos sinMargen">ALGUNOS ADICTOS A BYMARÍA </h2>
 </div>



@include('publica.donde.partials.carousel')

@endsection
