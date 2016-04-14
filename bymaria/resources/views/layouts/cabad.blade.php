<!DOCTYPE html>

	<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
 <style media="screen">

 @media (min-width: 768px)
 .navbar-nav {
     text-align: center;
     /* float: left; */
     margin: 0;
     /* width: 100%; */
 }

 </style>

    <title>Administrador</title>
		<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.9.1.js') }}"></script>
		<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
		{{-- js del menu --}}
		<script type="text/javascript" src="{{ URL::asset('assets/js/metisMenu.min.js') }}"></script>
		{{--js del navbar --}}
		<script type="text/javascript" src="{{ URL::asset('assets/js/sb-admin-2.js') }}"></script>

		<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}" />
		{{-- css del menu --}}
		<link rel="stylesheet" href="{{ URL::asset('assets/css/metisMenu.min.css') }}" />
		{{-- css del nav --}}
		<link rel="stylesheet" href="{{ URL::asset('assets/css/sb-admin-2.css') }}" />
		{{-- css iconos --}}
		<link rel="stylesheet" href="{{ URL::asset('assets/font-awesome-4.5.0/css/font-awesome.min.css') }} ">
		{{-- css del inicio sesion --}}
		<link rel="stylesheet" href="{{ URL::asset('assets/css/sigin.css') }}" />
		{{-- css admin --}}
		<link rel="stylesheet" href="{{ URL::asset('assets/css/dashboard.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('assets/css/admin.css') }}" />


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/inicio') }}">ByMaria ADMIN</a>


        </div>
        <div id="navbar" class="navbar-collapse collapse">
					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
							<!-- Authentication Links -->
							@if (Auth::guest())
									<li><a href="{{ url('/login') }}">Login</a></li>
									<li><a href="{{ url('/register') }}">Register</a></li>
							@else
									<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
													{{ Auth::user()->name }} <span class="caret"></span>
											</a>

											<ul class="dropdown-menu" role="menu">
													<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
											</ul>
									</li>
							@endif

					</ul>
        </div>
      </div>
    </nav>

 @include('layouts.lateral')

	 <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">


	 <div class="col-md-10 col-md-offset-1">
   @yield('content')

 </div>
</div>

@section('scripts')

    @show
			  </body>

			  </html>
