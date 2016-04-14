
@extends('layouts.cab')
@section('content')
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>

{!! Html::script('assets/js/mapaContac.js') !!}

{!! Html::script('assets/js/ajaxContacto.js') !!}


<div class="col-xs-12 col-sm-12 col-lg-10 col-centered panelContacto ">
  <div class="col-xs-12  col-sm-7 col-md-7 ">
    <div id="map-container"  ></div>
   </div>
   @include('publica.contacto.form')
</div>
@endsection
