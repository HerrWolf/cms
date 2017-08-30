<?php 

require_once "../../controllers/gestorMensajes.php";
require_once "../../models/gestorMensajes.php";

class Ajax{

	/*======================================================
	=            MARCAR MENSAJES COMO REVISADOS            =
	======================================================*/
	
	public $revisionMensajes;
	
	public function gestorRevisionMensajesAjax(){

		$datos = $this->revisionMensajes;
		
		$respuesta = MensajesController::mensajesRevisadosController($datos);

		echo $respuesta;
	}
	
	/*=====  End of MARCAR MENSAJES COMO REVISADOS  ======*/
	
}

/*===============================
=            OBJETOS            =
===============================*/

if (isset($_POST["revisionMensajes"])) {
	
	$a = new Ajax();
	$a -> revisionMensajes = $_POST["revisionMensajes"];
	$a -> gestorRevisionMensajesAjax();
}

/*=====  End of OBJETOS  ======*/
