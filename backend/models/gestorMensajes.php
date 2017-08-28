<?php 

require_once "conexion.php";

class MensajesModel{

	/*================================================
	=            MOSTRAR MENSAJES EN VIEW            =
	================================================*/
	
	
	public function mostrarMensajesModel($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT id, nombre, email, mensaje, fecha FROM $tabla ORDER BY fecha DESC");
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}
	
	/*=====  End of MOSTRAR MENSAJES EN VIEW  ======*/



	/*============================================
	=            BORRAR MENSAJE DE DB            =
	============================================*/
	
	
	public function borrarMensajesModel($datosModel, $tabla){
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datosModel, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();
	}
	
	/*=====  End of BORRAR MENSAJE DE DB  ======*/
	
	
}