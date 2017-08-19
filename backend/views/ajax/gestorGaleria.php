<?php

require_once "../../models/gestorGaleria.php";
require_once "../../controllers/gestorGaleria.php";

/*========================================
=            CLASES Y METODOS            =
========================================*/


class Ajax{

	/*==================================================
	=            SUBIR IMAGEN DE LA GALERIA            =
	==================================================*/
	
	
	public $imagenTemporal;

	public function gestorGaleriaAjax(){
		
		$datos = $this->imagenTemporal;

		$respuesta = GestorGaleria::mostrarImagenController($datos);

		echo $respuesta;
	}
	
	/*=====  End of SUBIR IMAGEN DE LA GALERIA  ======*/



	/*=============================================
	=            ELIMINAR ITEM GALERIA            =
	=============================================*/
	
	
	public $idGaleria;
	public $rutaGaleria;

	public function eliminarGaleriaAjax(){

		$datos = array("idGaleria"=>$this->idGaleria,
			           "rutaGaleria"=>$this->rutaGaleria);

		$respuesta = GestorGaleria::eliminarGaleriaController($datos);

		echo $respuesta;
	}
	
	/*=====  End of ELIMINAR ITEM GALERIA  ======*/



	/*========================================
	=            ACTUALIZAR ORDEN            =
	========================================*/
	
		
	public $actualizarOrdenGaleria;
	public $actualizarOrdenItem;

	public function actualizarOrdenAjax(){
		
		$datos = array("ordenGaleria"=>$this->actualizarOrdenGaleria,
			           "ordenItem"=>$this->actualizarOrdenItem);

		$respuesta = GestorGaleria::actualizarOrdenController($datos);

		echo $respuesta;
	}
	
	/*=====  End of ACTUALIZAR ORDEN  ======*/
	
	
	

}

/*=====  End of CLASES Y METODOS  ======*/




/*===============================
=            OBJETOS            =
===============================*/


if (isset($_FILES["imagen"]["tmp_name"])) {
	
	$a = new Ajax();
	$a -> imagenTemporal = $_FILES["imagen"]["tmp_name"];
	$a -> gestorGaleriaAjax();
}

if (isset($_POST["idGaleria"])) {
	
	$b = new Ajax();
	$b -> idGaleria = $_POST["idGaleria"];
	$b -> rutaGaleria = $_POST["rutaGaleria"];
	$b -> eliminarGaleriaAjax();
}

if (isset($_POST["actualizarOrdenGaleria"])) {
	
	$c = new Ajax();
	$c -> actualizarOrdenGaleria = $_POST["actualizarOrdenGaleria"];
	$c -> actualizarOrdenItem = $_POST["actualizarOrdenItem"];
	$c -> actualizarOrdenAjax();
}



/*=====  End of OBJETOS  ======*/
