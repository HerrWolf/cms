<?php

class GestorSlide{

	/*=====================================================
	=            MOSTRAR IMAGEN SLIDE CON AJAX            =
	=====================================================*/
	
		
	public function mostrarImagenController($datos){

		#getimagesize() - obtiene el tamaño de la imagen
		#list(): al igual que array(), no es realmente una funcion, es un constructor del lenguaje
		#list() - se utiliza para asignar una lista de variables en una sola operacion

		list($ancho,$alto) = getimagesize($datos["imagenTemporal"]);

		if ($ancho < 1600 || $alto < 600) {
			
			echo 0;
		}
		else{

			$aleatorio = mt_rand(100, 999);
			
			$ruta = "../../views/images/slide/slide".$aleatorio.".jpg";

			#imagecreatefromjpeg() - crea una nueva imagen apartir de un fichero o una URL

			$origen = imagecreatefromjpeg($datos["imagenTemporal"]);

			#imagecrop() - Recortando una imagen usando las coordenadas, el tamaño, x, y, ancho y alto dados

			$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>1600, "height"=>600]);
			
			#imagejpeg() - exporta la imagen al navegador o a un fichero

			imagejpeg($destino, $ruta);

			GestorSlideModel::subirImagenSlideModel($ruta, "slide");

			$respuesta = GestorSlideModel::mostrarImagenSlideModel($ruta,"slide");

			$enviarDatos = array("ruta" => $respuesta["ruta"],
				                 "titulo" => $respuesta["titulo"],
				                 "descripcion" => $respuesta["descripcion"]);

			echo json_encode($enviarDatos);
		}

	}

	/*=====  End of MOSTRAR IMAGEN SLIDE CON AJAX  ======*/



	/*=================================================
	=            MOSTRAR IMAGENES EN VIEWS            =
	=================================================*/
	
	

	public function mostrarImagenVistaController(){

		$respuesta = GestorSlideModel::mostrarImagenVistaModel("slide");

		foreach ($respuesta as $row => $item) {
			
			echo '<li id="'.$item["id"].'" class="bloqueSlide"><span class="fa fa-times eliminarSlide"></span><img src="'.substr($item["ruta"],6).'" class="handleImg"></li>';
		}

	}
	
	/*=====  End of MOSTRAR IMAGENES EN VIEWS  ======*/



	/*====================================================
	=            MOSTRAR IMAGENES PARA EDITAR            =
	====================================================*/
	
	
	public function editorSlideController(){

		$respuesta = GestorSlideModel::mostrarImagenVistaModel("slide");

		foreach ($respuesta as $row => $item) {
			
			echo '<li id="item'.$item["id"].'"><span class="fa fa-pencil" style="background:blue"></span><img src="'.substr($item["ruta"],6).'" style="float:left; margin-bottom:10px" width="80%"><h1>'.substr($item["titulo"],6).'</h1><p>'.substr($item["descripcion"],6).'</p></li>';
		}
	}
	
	/*=====  End of MOSTRAR IMAGENES PARA EDITAR  ======*/



	/*===============================================
	=            ELIMINAR ITEM DEL SLIDE            =
	===============================================*/
	
	
	public function eliminarSlideController($datos){

		$respuesta = GestorSlideModel::eliminarSlideModel($datos,"slide");
	}
	
	/*=====  End of ELIMINAR ITEM DEL SLIDE  ======*/
	
	
	
}