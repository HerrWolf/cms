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
			
			echo '<li id="'.$item["id"].'" class="bloqueSlide"><span class="fa fa-times eliminarSlide" ruta="'.$item["ruta"].'"></span><img src="'.substr($item["ruta"],6).'" class="handleImg"></li>';
		}

	}
	
	/*=====  End of MOSTRAR IMAGENES EN VIEWS  ======*/



	/*====================================================
	=            MOSTRAR IMAGENES PARA EDITAR            =
	====================================================*/
	
	
	public function editorSlideController(){

		$respuesta = GestorSlideModel::mostrarImagenVistaModel("slide");

		foreach ($respuesta as $row => $item) {
			
			echo '<li id="item'.$item["id"].'"><span class="fa fa-pencil editarSlide" style="background:blue"></span><img src="'.substr($item["ruta"],6).'" style="float:left; margin-bottom:10px" width="80%"><h1>'.$item["titulo"].'</h1><p>'.$item["descripcion"].'</p></li>';
		}
	}
	
	/*=====  End of MOSTRAR IMAGENES PARA EDITAR  ======*/



	/*===============================================
	=            ELIMINAR ITEM DEL SLIDE            =
	===============================================*/
	
	
	public function eliminarSlideController($datos){

		$respuesta = GestorSlideModel::eliminarSlideModel($datos,"slide");

		unlink($datos["rutaSlide"]);
	}
	
	/*=====  End of ELIMINAR ITEM DEL SLIDE  ======*/



	/*=============================================
	=            ACTUALIZAR ITEM SLIDE            =
	=============================================*/
	
	
	public function actualizarSlideController($datos){

		GestorSlideModel::actualizarSlideModel($datos,"slide");
		$respuesta = GestorSlideModel::seleccionarActualizacionSlideModel($datos,"slide");

		$enviarDatos = array("titulo" => $respuesta["titulo"],
				             "descripcion" => $respuesta["descripcion"]);

		echo json_encode($enviarDatos);
	}
	
	/*=====  End of ACTUALIZAR ITEM SLIDE  ======*/



	/*========================================
	=            ACTUALIZAR ORDEN            =
	========================================*/
	
	
	public function actualizarOrdenController($datos){
		
		GestorSlideModel::actualizarOrdenModel($datos, "slide");
		
		$respuesta = GestorSlideModel::seleccionarOrdenModel("slide");

		foreach ($respuesta as $row => $item) {
			echo '<li id="item'.$item["id"].'"><span class="fa fa-pencil editarSlide" style="background:blue"></span><img src="'.substr($item["ruta"],6).'" style="float:left; margin-bottom:10px" width="80%"><h1>'.$item["titulo"].'</h1><p>'.$item["descripcion"].'</p></li>';
		}
	}
	
	/*=====  End of ACTUALIZAR ORDEN  ======*/
	
	
	/*================================================
	=            MOSTRAR SLIDE EN BACKEND            =
	================================================*/
	
	
	public function seleccionarSlideController(){
		
		$respuesta = GestorSlideModel::seleccionarSlideModel("slide");

		foreach ($respuesta as $row => $item) {
			
			echo '<li>
	           		  <img src="'.substr($item["ruta"],6).'">
	           	      <div class="slideCaption">
		           		  <h3>'.$item["titulo"].'</h3>
				   		  <p>'.$item["descripcion"].'</p>
	           	      </div>
                  </li>';
		}
	}
	
	/*=====  End of MOSTRAR SLIDE EN BACKEND  ======*/
	
	
	
}