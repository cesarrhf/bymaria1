

<?php

$mensaje = "
<!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional //EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html>
<head>
	<title>Nuevo Pedido - La Vega Delivery</title>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
	<style type='text/css'>
		/* Client-specific Styles */
		#outlook a{padding:0;} /* Force Outlook to provide a 'view in browser' button. */
		body{width:100% !important;} .ReadMsgBody{width:100%;} .ExternalClass{width:100%;} /* Force Hotmail to display emails at full width */
		body{-webkit-text-size-adjust:none;} /* Prevent Webkit platforms from changing default text sizes. */

		/* Reset Styles */
		body{margin:0; padding:0;}
		img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;}
		table td{border-collapse:collapse;}
		#backgroundTable{height:100% !important; margin:0; padding:0; width:100% !important;}

		body{
			margin: 0px;
			padding: 0px;
			background-color: #dedede;
			font-family: lucida sans unicode,lucida grande,sans-serif;;
			font-weight: normal;
			color: grey;
			font-size: 1.2em;

		}

		a{
			text-decoration: none;
		}

		#contenedor{
			margin: 10px;
			width: 640px;
		}

		#header{
			background-color: rgb(26,38,47);
			color: #eee;
			padding: 10px;
			font-size: 0.7em;
			border-radius:6px 6px 0px 0px;
			-moz-border-radius: 6px 6px 0px 0px;
			-webkit-border-radius:6px 6px 0px 0px;
			text-align: center;
		}

		#footer{
			background-color: rgb(26,38,47);
			color: #eee;
			padding: 10px;
			font-size: 0.7em;
			border-radius:0px 0px 6px 6px;
			-moz-border-radius: 0px 0px 6px 6px;
			-webkit-border-radius:0px 0px 6px 6px;
			text-align: center;
		}

		#contenido{
			background-color: #ffffff;
		}

		#logo{
			text-align: center;
			margin-top: 15px;
		}

		h1{
			font-size: 1.5em;
			    color: #656565;
		}

		#textos{
			padding: 10px;
			width: 100%;
		}

		p{
			font-size: 0.9em;
			    color: #656565;
		}

		.turqueza{
			color: rgba(0,172,161,1);
		}

		td{
			vertical-align: top;
			  color: #656565;
		}

		.items{
			font-size: 0.9em;
			padding: 10px;
		}

		#entrega{
			font-size: 0.9em;
			padding: 10px;
		}

		.codigo{

			width: 60px;
		}

		.label{
			font-size: 0.8em;

		}

		.total{
			font-size: 1.3em;

		}

		.right{
			text-align: right;
		}

		.center{
			text-align: center;
		}

		.direccion{
			width: 150px;
		}

		.nombre{
			width: 150px;
		}

		.color{
			width: 10px;
			height: 10px;
			border-radius:5px;
			-moz-border-radius: 5px;
			-webkit-border-radius:5px;
			display: inline-block;
		}

		.margen_direcciones{
			width: 60px;
		}

		.mini{
			font-size: 0.8em;
		}

		h2{
			font-size: 1.2em;
			margin: 0px;
		}

		#items{
			width: 100%;
			border: 1px solid #ccc;
			border-collapse: collapse;
		}

		#items img{
			height: 80px;
		}

		#items td{
			vertical-align: middle;
			border: 1px solid #ccc;
			padding: 10px;
		}

		#items tr{
					}

		#items th{
			background-color: #e7e7e7;
			padding: 10px 5px;
			border: 1px solid #e7e7e7;
 		}

		#info_transaccion{
			font-size: 0.8em;
			width: 100%;
		}

		#info_transaccion th{
			background-color: #e7e7e7;
			padding: 5px;
			border: 1px solid #eee;
			text-align: left;

		}

		#info_transaccion td{
			background-color: #eee;
			padding: 5px;
			text-align: right;
		}
	</style>
</head>
<body style='margin: 0px; padding: 0px; background-color: #dedede; font-family: lucida sans unicode,lucida grande,sans-serif;  font-weight: normal; color: grey;'>
	<table width='100%' cellpadding='0' cellspacing='0' border='0' id='backgroundTable'>
		<tbody>
			<tr>
				<td style='vertical-align: top;' align='center' bgcolor='white'>
					<table id='contenedor' style='margin:10px; width: 640px;' cellpadding='0' cellspacing='0' border='0'>
					<tbody>

						<!-- FIN HEADER -->
						<tr>
							<td style='vertical-align: top; background-color: #ffffff;' id='contenido'>
								<table align='center' id='logo' style='text-align: center; margin-top: 15px;'>
									<tr>
										<td style='vertical-align: top;'>
											<img src='http://www.cecsoluciones.cl/servicios/imagenes/logo_bymaria/fucsia_150.png' height='120'>
										</td>
									</tr>
								</table>
								<hr style='border-top: 1px solid #EAEAEA;width: 100%;'>

								<table id='textos' style=''>
									<tr>
										<td style='vertical-align: top;'>
											<p style='font-size: 0.9em;'>Hola {$nombre} ¡TU PEDIDO FUE UN ÉXITO!   ,</span></p>
											<p style='font-size: 0.9em;'>Nº PEDIDO #{$ped }.</p>
											<p style='font-size: 0.9em;'>{$nombre} {$apellido}.</p>
 											<p style='font-size: 0.9em;'>{$calle} {$numero} {$dpto}.</p>
											<p style='font-size: 0.9em;'>{$comuna}.</p>
											<p style='font-size: 0.9em;'>{$email}.</p>
											<br>
											<p style='font-size: 0.9em;'>A CONTINUACIÓN UN RESUMEN DE TU PEDIDO:</p>

											<br>

											<table id='items' style='width:100%; border-collapse: collapse;' >
												<tr style='border-bottom: 2px solid #EAEAEA;'>

											  	<th style='text-align:left; font-size: 0.7em; font-weight: normal;'>ITEM</th>
													<th></th>
 													<th style=' font-size: 0.7em; font-weight: normal;' class='rigth'>CANTIDAD</th>
													<th style=' font-size: 0.7em; font-weight: normal;' class='right'>VALOR</th>
												</tr>";
											$mensaje.=$items;
											$mensaje .= "<tr  style='border-top: 2px solid #EAEAEA;'>
												<td colspan='4' style='padding-top: 10px; padding-bottom: 10px; text-align:center;font-size: 1.3em''>SUB TOTAL $".number_format($total,0,",",".")."</td>
												</tr>

												<tr style='border-bottom: 2px solid #EAEAEA;'>

												<td colspan='4' style='text-align:center; padding-top: 10px; padding-bottom: 10px;font-size: 1.3em''>ENVÍO $".number_format($despacho,0,",",".")."</td>
											</tr>
											<tr>
												<td colspan='4' style='text-align:center; padding-top: 10px; padding-bottom: 10px; font-size: 1.3em';>TOTAL $".number_format((int)$total+(int)$despacho,0,",",".")."</td>
											</tr>
											</table>

											<p>Recuerda que luego de confirmar el pedido deberás hacer una transferencia bancaria. Debes enviar el comprobante de transferencia a pedidos@bymaria.cl indicando el número de pedido  {$ped } . Esto debe ser a más tardar a las 22:00 horas del día anterior al despacho.</p>
											<p>BANCO: BCI (Banco Crédito e Inversiones)
												<br>
												TIPO CUENTA: Cuenta Corriente
												<br>
												Nº CUENTA: 61465046
												<br>
												NOMBRE: ByMaria Limitada
												<br>
												RUT: 76.508.219-6
												<br>
												EMAIL: pedidos@bymaria.cl
											</p>
											<p>
											Por favor ten presente también que debe haber alguien disponible para recibir el pedido el día 01-03-2016. El despacho podría ser entre las 11:00 y las 19:00 horas. Cualquier inquietud que tengas no dudes en escribirnos a pedidos@bymaria.cl	</p>

											<br>
										</td>
									</tr>
									<tr align=center>
										<td >
										  <a href='https://www.facebook.com/productosbymaria' target='_blank'>
											<img src='http://www.cecsoluciones.cl/servicios/imagenes/color-facebook-48.png' style='' height='24' width='24' class=''></a>
											<a href='https://www.instagram.com/_bymaria/' target='_blank'><img src='http://www.cecsoluciones.cl/servicios/imagenes/color-instagram-48.png' style='' height='24' width='24' class=''>
										  </a>
										</td>


									</tr>
									<tr>
										<td style='vertical-align: top;'>
									  	<h2 style='font-size: 1.2em;  text-align:center; margin: 0px;'>QUE TENGAS UN MARAVILLOSO DÍA</h2>
											<h2 style='font-size: 0.9em; text-align:center; margin: 0px;'>SALUDOS, EQUIPO BY MARÍA</h2>
										</td>
									</tr>

								</table>
							</td>
						</tr>
						<!-- FIN CONTENIDO -->
						<tr>
							<td id='footer' style='background-color: white; color: #eee; padding: 10px; font-size: 0.7em; border-radius:0px 0px 6px 6px; -moz-border-radius: 0px 0px 6px 6px; -webkit-border-radius:0px 0px 6px 6px; text-align: center;'>
 						</tr>
						<!-- FIN FOOTER -->
					</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>";
echo $mensaje;
?>
