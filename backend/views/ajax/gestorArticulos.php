<?php 

require_once "../../controllers/gestorArticulos.php";

/*========================================
=            CLASES Y METODOS            =
========================================*/


class Ajax{

	#Subir la imagen del articulo
	public $imagenTemporal;

	public function gestorArticulosAjax(){

		$datos = $this->imagenTemporal;

		$respuesta = GestorArticulos::mostrarImagenController($datos);

		echo $respuesta;
	}
}

/*=====  End of CLASES Y METODOS  ======*/




/*===============================
=            Objetos            =
===============================*/


if (isset($_FILES["imagen"]["tmp_name"])) {
	
	$a = new Ajax();
	$a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
	$a -> gestorArticulosAjax();
}

/*=====  End of Objetos  ======*/
