<?php 

require_once "../../controllers/gestorVideos.php";
require_once "../../models/gestorVideos.php";

/*========================================
=            CLASES Y METODOS            =
========================================*/


class Ajax{

	#Subir video
	public $videoTemporal;

	public function gestorVideoAjax(){

		$datos = $this->videoTemporal;

		$respuesta = GestorVideos::mostrarVideoController($datos);

		echo $respuesta;
	}


	#Eliminar Video

	public $idVideo;
	public $rutaVideo;

	public function eliminarVideoAjax(){
		
		$datos = array("idVideo"=>$this->idVideo,
			           "rutaVideo"=>$this->rutaVideo);

		$respuesta = GestorVideos::eliminarVideoController($datos);

		echo $respuesta;
	}





}

/*=====  End of CLASES Y METODOS  ======*/



/*===============================
=            OBJETOS            =
===============================*/


if (isset($_FILES["video"]["tmp_name"])) {
	
	$a = new Ajax();
	$a -> videoTemporal = $_FILES["video"]["tmp_name"];
	$a -> gestorVideoAjax();
}

if (isset($_POST["idVideo"])) {
	
	$b = new Ajax();
	$b -> idVideo = $_POST["idVideo"];
	$b -> rutaVideo = $_POST["rutaVideo"];
	$b -> eliminarVideoAjax();
}

/*=====  End of OBJETOS  ======*/
