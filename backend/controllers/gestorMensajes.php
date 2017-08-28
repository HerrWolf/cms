<?php 

class MensajesController{

	/*================================================
	=            MOSTRAR MENSAJES EN VIEW            =
	================================================*/
	
	
	public function mostrarMensajesController(){
		
		$respuesta = MensajesModel::mostrarMensajesModel("mensajes");

		foreach ($respuesta as $row => $item) {
			
			echo '<div class="well well-sm" id="'.$item["id"].'">
		
					<a href="index.php?action=mensajes&idBorrar='.$item["id"].'"><span class="fa fa-times pull-right"></span></a>
					<p>'.$item["fecha"].'</p>
					<h3>De: '.$item["nombre"].'</h3>
					<h5>Email: '.$item["email"].'</h5>
				  	<input type="text" class="form-control" value="'.$item["mensaje"].'" readonly>
				  	<br>
				  	<button class="btn btn-info btn-sm leerMensaje">Leer</button>

				  </div>';
		}
	}
	
	/*=====  End of MOSTRAR MENSAJES EN VIEW  ======*/



	/*=======================================
	=            BORRAR MENSAJES            =
	=======================================*/
	
	
	public function borrarMensajesController(){
		
		if (isset($_GET["idBorrar"])) {

			$datosController = $_GET["idBorrar"];

			$respuesta = MensajesModel::borrarMensajesModel($datosController, "mensajes");

			if ($respuesta == "ok") {
				
				echo '<script>

						swal({
							title: "¡OK!",
							text: "¡El mensaje se ha borrado correctamente!",
							type: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							},

						function(isConfirm){
							if(isConfirm){
								window.location = "mensajes";
							}
						});
				
					 </script>';
			}


		}
	}
	
	/*=====  End of BORRAR MENSAJES  ======*/



	/*==========================================
	=            RESPONDER MENSAJES            =
	==========================================*/
	
	
	public function responderMensajesController(){
		
		if (isset($_POST["enviarEmail"])) {
			
			$email = $_POST["enviarEmail"];
			$nombre = $_POST["enviarNombre"];
			$titulo = $_POST["enviarTitulo"];
			$mensaje = $_POST["enviarMensaje"];

			$para = $email.', ';
			$para .= 'webmasterp2m@gmail.com';

			$titulo = 'Respuesta a su mensaje';

			$mensaje = '<html>
						<head>
							<title>Respuesta a su mensaje</title>
						</head>
							<body>
								<h1>Hola '.$nombre.'</h1>
								<p>'.$mensaje.'</p>
								<hr>
								<p><b>HerrWolf</b><br>
								Estudiante de programacion en php<br>
								Ensenada B.C., Mexico<br>
								WhatsApp: 6462130508<br>
								webmasterp2m@gmail.com</p>

								<h3><a href="http://tkilla.com" target="blank">www.tkilla.com</a></h3>

								<a href="http://facebook.com" target="blank"><img src="https://s23.postimg.org/cb2i89a23/facebook.jpg"></a>
								<a href="http://twitter.com" target="blank"><img src="https://s23.postimg.org/mcbxvbciz/youtube.jpg"></a>
								<a href="http://youtube.com" target="blank"><img src="https://s23.postimg.org/tcvcacox7/twitter.jpg"></a>
								<br>

								<img src="https://s23.postimg.org/dsnyjtesr/unnamed.jpg">

							</body>
						</html>';

			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		    $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		    $cabeceras .= 'From: <webmasterp2m@gmail.com>' . "\r\n";

		    $envio = mail($para, $titulo, $mensaje, $cabeceras);

		    if ($envio) {
		    	
		    	echo '<script>

						swal({
							title: "¡OK!",
							text: "¡El mensaje se ha enviado correctamente!",
							type: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							},

						function(isConfirm){
							if(isConfirm){
								window.location = "mensajes";
							}
						});
				
					 </script>';
		    }


		}
	}
	
	/*=====  End of RESPONDER MENSAJES  ======*/



	/*============================================
	=            ENVIAR CORREO MASIVO            =
	============================================*/
	
	
	public function mensajesMasivosController(){
		
		if (isset($_POST["tituloMasivo"])) {

			$respuesta = MensajesModel::seleccionarEmailSuscriptores("suscriptores");

			foreach ($respuesta as $row => $item) {
				
				$titulo = $_POST["tituloMasivo"];
				$mensaje = $_POST["mensajeMasivo"];

				$titulo = "Mensaje para todos";
				$para = $item["email"];

				$mensaje = '<html>
							<head>
								<title>Respuesta a su mensaje</title>
							</head>
								<body>
									<h1>Hola '.$item["nombre"].'</h1>
									<p>'.$mensaje.'</p>
									<hr>
									<p><b>HerrWolf</b><br>
									Estudiante de programacion en php<br>
									Ensenada B.C., Mexico<br>
									WhatsApp: 6462130508<br>
									webmasterp2m@gmail.com</p>

									<h3><a href="http://tkilla.com" target="blank">www.tkilla.com</a></h3>

									<a href="http://facebook.com" target="blank"><img src="https://s23.postimg.org/cb2i89a23/facebook.jpg"></a>
									<a href="http://twitter.com" target="blank"><img src="https://s23.postimg.org/mcbxvbciz/youtube.jpg"></a>
									<a href="http://youtube.com" target="blank"><img src="https://s23.postimg.org/tcvcacox7/twitter.jpg"></a>
									<br>

									<img src="https://s23.postimg.org/dsnyjtesr/unnamed.jpg">

								</body>
							</html>';

				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			    $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			    $cabeceras .= 'From: <webmasterp2m@gmail.com>' . "\r\n";

			    $envio = mail($para, $titulo, $mensaje, $cabeceras);

			    if ($envio) {
			    	
			    	echo '<script>

							swal({
								title: "¡OK!",
								text: "¡El mensaje se ha enviado correctamente!",
								type: "success",
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								},

							function(isConfirm){
								if(isConfirm){
									window.location = "mensajes";
								}
							});
					
						 </script>';
			    }
			}			
		}
	}
	
	/*=====  End of ENVIAR CORREO MASIVO  ======*/

		
	
			
}