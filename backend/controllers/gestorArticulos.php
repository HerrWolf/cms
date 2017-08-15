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



	/*===============================================
	=            GUARDAR ARTICULOS EN DB            =
	===============================================*/
	
		
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
				                     "introduccion"=>$_POST["introArticulo"]."...",
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
								window.location = "articulos";
							}
						});
				
					 </script>';
			}
			else{

				echo $respuesta;
			}

		}
	}

	/*=====  End of GUARDAR ARTICULOS EN DB  ======*/



	/*=================================================
	=            MOSTRAR ARTICULOS EN VIEW            =
	=================================================*/
	
	
	public function mostrarArticulosController(){
		
		$respuesta = GestorArticulosModel::mostrarArticulosModel("articulos");

		foreach ($respuesta as $row => $item) {
			
			echo '<li id="'.$item["id"].'">
					<span>
					<a href="index.php?action=articulos&idBorrar='.$item["id"].'&rutaImagen='.$item["ruta"].'"><i class="fa fa-times btn btn-danger"></i></a>
					<i class="fa fa-pencil btn btn-primary editarArticulo"></i>	
					</span>
					<img src="'.$item["ruta"].'" class="img-thumbnail">
					<h1>'.$item["titulo"].'</h1>
					<p>'.$item["introduccion"].'</p>
					<input type="hidden" value="'.$item["contenido"].'">
					<a href="#articulo'.$item["id"].'" data-toggle="modal">
					<button class="btn btn-default">Leer Más</button>
					</a>

					<hr>

				</li>

				<div id="articulo'.$item["id"].'" class="modal fade">

					<div class="modal-dialog modal-content">

						<div class="modal-header" style="border:1px solid #eee">
				        
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h3 class="modal-title">'.$item["titulo"].'</h3>
					        
						</div>

						<div class="modal-body" style="border:1px solid #eee">
					        
							<img src="'.$item["ruta"].'" width="100%" style="margin-bottom:20px">
							<p class="parrafoContenido">'.$item["contenido"].'</p>
					        
						</div>

						<div class="modal-footer" style="border:1px solid #eee">
					        
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        
						</div>

					</div>

				</div>';
		}
	}
	
	/*=====  End of MOSTRAR ARTICULOS EN VIEW  ======*/



	/*============================================
	=            BORRAR ATICULO DE DB            =
	============================================*/
	
	
	public function borrarArticuloController(){
		
		if (isset($_GET["idBorrar"])) {
			
			unlink($_GET["rutaImagen"]);

			$datosController = $_GET["idBorrar"];

			$respuesta = GestorArticulosModel::borrarArticuloModel($datosController,"articulos");

			if ($respuesta == "ok") {
				
				echo '<script>

						swal({
							title: "¡OK!",
							text: "¡El articulo se ha borrado correctamente!",
							type: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							},

						function(isConfirm){
							if(isConfirm){
								window.location = "articulos";
							}
						});
				
					 </script>';
			}
			
		}
	}
	
	/*=====  End of BORRAR ATICULO DE DB  ======*/



	/*=======================================
	=            EDITAR ARTICULO            =
	=======================================*/
	
	
	public function editarArticuloController(){
		
		$ruta = "";

		if (isset($_POST["editarTitulo"])) {
			
			if (isset($_FILES["editarImagen"]["tmp_name"])) {
				
				$imagen = $_FILES["editarImagen"]["tmp_name"];

				$aleatorio = mt_rand(100,999);

				$ruta = "views/images/articulos/articulo".$aleatorio.".jpg";

				$origen = imagecreatefromjpeg($imagen);
				
				$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>800, "height"=>400]);

				imagejpeg($destino, $ruta);

				$borrar = glob("views/images/articulos/temp/*");

				foreach ($borrar as $file) {
					
					unlink($file);
				}
			}

			if ($ruta == "") {
			
				$ruta = $_POST["fotoAntigua"];
			}
			else{

				unlink($_POST["fotoAntigua"]);
			}

			$datosController = array("id"=>$_POST["id"],
				                     "titulo"=>$_POST["editarTitulo"],
				                     "introduccion"=>$_POST["editarIntroduccion"],
				                     "ruta"=>$ruta,
				                     "contenido"=>$_POST["editarContenido"]);

			$respuesta = GestorArticulosModel::editarArticuloModel($datosController, "articulos");

			if ($respuesta == "ok") {
				
				echo '<script>

						swal({
							title: "¡OK!",
							text: "¡El articulo se ha actualizado correctamente!",
							type: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							},

						function(isConfirm){
							if(isConfirm){
								window.location = "articulos";
							}
						});
				
					 </script>';
			}
			else{

				echo $respuesta;
			}
		}
	}

	/*=====  End of EDITAR ARTICULO  ======*/
	

				
}