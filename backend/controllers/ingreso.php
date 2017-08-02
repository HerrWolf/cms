<?php 

class Ingreso{

	public function ingresoController(){

		#Checamos si la variable $_POST viene llena si es asi se procede a validar con preg_match
		if (isset($_POST["usuarioIngreso"])) {

			#Con preg_match validamos que no se esten mandando caracteres especiales dentro del usuario y password comparandolo con una expresion regular que evita que se pasen caracteres especiales.
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuarioIngreso"] ) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["passwordIngreso"] )) {

				#$encriptar = crypt($_POST["passwordIngreso"],'$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datosController = array(
				"usuario" => $_POST["usuarioIngreso"],
				"password" => $_POST["passwordIngreso"] 
				);

				$respuesta = IngresoModels::ingresoModel($datosController, "usuarios");

				#control de intentos de login
				$intentos = $respuesta["intentos"];
				$usuarioActual = $_POST["usuarioIngreso"];
				$maximoIntentos = 2;

				if ($intentos < $maximoIntentos) {

					if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){

						$intentos = 0;

						$datosController = array("usuarioActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);

						$respuesta = IngresoModels::intentosModel($datosController, "usuarios");

						session_start();
						$_SESSION["validar"] = true;
						$_SESSION["usuario"] = $usuarioActual;

						header("location: inicio");	
					}

					else{

						++$intentos;

						$datosController = array("usuarioActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);

						$respuesta = IngresoModels::intentosModel($datosController, "usuarios");

						echo '<div class="alert alert-danger">Error al ingresar</div>';	
					}
				}

				else{

					$intentos = 0;

						$datosController = array("usuarioActual"=>$usuarioActual, "actualizarIntentos"=>$intentos);

						$respuesta = IngresoModels::intentosModel($datosController, "usuarios");

						echo '<div class="alert alert-danger">Ha fallado 3 veces, favor de resolver el captcha</div>';
				}
			}
		}
	}
	
}