
@extends('layouts.cab')
@section('content')


{!! Html::script('assets/js/index.js') !!}

 @include('publica.index.partials.carousel')

<div  class="col-xs-12 col-md-10 col-lg-10 col-centered" style="margin-top: 12px;">
<h2 style="margin-top=20px;" class="text-center titulos">PRODUCTOS ALTAMENTE ADICTIVOS</h2><br>
</div>
  @include('publica.index.partials.productos')
@endsection
