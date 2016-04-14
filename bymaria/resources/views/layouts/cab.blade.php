 <?php
 //AL APRETAR ATRAS, NO BUSQUE DEL CACHE! SI NO QUE RECARGUE LA PAGINA!
 header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
 header("Pragma: no-cache"); // HTTP 1.0.
 header("Expires: 0"); // Proxies.

if(!isset($_COOKIE["idUsuario"])){
  $vID	=	uniqid().date("YmdHis");
  setcookie("idUsuario", $vID, time()+3600*24*30*12, "/");
}else{
  $vID  = $_COOKIE["idUsuario"];
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ByMaria</title>

  <script src="https://use.typekit.net/wbc3meh.js"></script>
  <script>try{Typekit.load();}catch(e){}</script>
	<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.9.1.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
	<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('assets/css/public.css') }}" />
	<link rel="stylesheet" href="{{ URL::asset('assets/font-awesome-4.5.0/css/font-awesome.min.css') }} ">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


</head>
<body cz-shortcut-listen="true">
	<!-- <body cz-shortcut-listen="true" data-spy="scroll" data-target="#myScrollspy" data-offset="15"> -->

  <div class="container ">
<!-- The justified navigation menu is meant for single line per list item.
         Multiple lines will require custom code not provided by Bootstrap. -->
    <div class="masthead ">
<a href="/">
	<img  class="img-responsive center-block logo" src="imagenes/logo_bymaria/logo.png" alt=""/>
</a>
<div class="row row-centered">
      <!-- barra de navegacion -->
			<div class="col-xs-12 col-md-10 col-centered  ">
				<div class="navbar">
					<div class="navbar">
						<div class="navbar-inner">
								<ul class="nav nav-center text">
                    <li><a href="/bymaria">HOME</a></li>
								  	<li><a href="donde">DÓNDE COMPRAR</a></li>
										<li><a href="tienda">TIENDA ONLINE</a></li>
										<li><a href="contacto">CONTACTO</a></li>
								</ul>
						</div>
				</div>
      </div>
			<!--/.container-fluid -->

</div>



 	@yield('content')


</body>
<!-- Site footer -->

	<footer class="footer ">
		<div class="col-xs-12 col-md-10 col-centered  ">
			<p class="text-center">
				<a href="http://www.instagram.com/_bymaria">
					<span class="fa-stack fa-lg ">
						<i class="fa fa-instagram fa-stack-2x" style="font-size:1.4em;"></i>
					</span>
			 </a>
			<a href="http://www.facebook.com/productosbymaria">
		<span class="fa-stack fa-lg">
			<i class="fa fa-facebook fa-stack-2x" style="font-size:1.4em;"></i>
		</span>
	</a>

		</p>
			<p class="text-center">© BYMARIA CONSERVAS LIMITADA.	</p>
		</div>
 </footer>
 </div>
</div> <!-- /container -->

</html>
