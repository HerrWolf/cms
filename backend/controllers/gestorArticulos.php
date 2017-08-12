<?php

class GestorArticulos{
	
	/*===============================================
	=            MOSTRAR IMAGEN ARTICULO            =
	===============================================*/
	
			
	public function mostrarImagenController($datos){

		list($ancho,$alto) = getimagesize($datos);
		
		if ($ancho < 800 || $alto < 400) {

			echo 0;
		}
		else{

			$aleatorio = mt_rand(100, 999);

			$ruta = "../../views/images/articulos/temp/articulo".$aleatorio.".jpg";

			$origen = imagecreatefromjpeg($datos);
			
			$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>800, "height"=>400]);

			imagejpeg($destino, $ruta);

			echo $ruta;
		}
	}

	/*=====  End of MOSTRAR IMAGEN ARTICULO  ======*/



	public function guardarArticuloController(){
		
		if (isset($_POST["tituloArticulo"])) {
			
			//recibimos la imagen que viene en la variable post
			$imagen = $_FILES["imagen"]["tmp_name"];

			//Eliminar las imagenes temporales con el metodo glob y un ciclo foreach
			$borrar = glob("views/images/articulos/temp/*");

			foreach ($borrar as $file) {
				
				unlink($file);
			}

			//crear nuevo nombre de imagen que se va a subir
			$aleatorio = mt_rand(100,999);

			$ruta = "views/images/articulos/articulo".$aleatorio.".jpg";

			$origen = imagecreatefromjpeg($imagen);
			
			$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>800, "height"=>400]);

			imagejpeg($destino, $ruta);

			$datosController = array("titulo"=>$_POST["tituloArticulo"],
				                     "introduccion"=>$_POST["introArticulo"],
				                     "ruta"=>$ruta,
				                     "contenido"=>$_POST["contenidoArticulo"]);

			$respuesta = GestorArticulosModel::guardarArticuloModel($datosController,"articulos");

			if ($respuesta == "ok") {
				
				echo '<script>

						swal({
							title: "¡OK!",
							text: "¡La imagen se subio corectamente!",
							type: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							},

						function(isConfirm){
							if(isConfirm){
								window.location = "slide";
							}
						});
				
					 </script>';
			}
			else{

				echo $respuesta;
			}

		}
	}
}