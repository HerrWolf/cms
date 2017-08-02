<?php

require_once "../../models/gestorSlide.php";
require_once "../../controllers/gestorSlide.php";


/*=======================================
=            CLASE Y METODOS            =
=======================================*/


class Ajax{
	
	#Subir imagen slide
	public $nombreImagen;
	public $imagenTemporal;

	public function gestorSlideAjax(){

		$datos = array("nombreImagen"=>$this->nombreImagen,
			           "imagenTemporal"=>$this->imagenTemporal);

		$respuesta = GestorSlide::mostrarImagenController($datos);

		echo $respuesta;
	}
}

/*=====  End of CLASE Y METODOS  ======*/



/*===============================
=            OBJETOS            =
===============================*/


$a = new Ajax();
$a -> nombreImagen = $_FILES["imagen"]["name"];
$a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
$a -> gestorSlideAjax();

/*=====  End of OBJETOS  ======*/
