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



	/*================================================
	=            SELECCIONAR SUSCRIPTORES            =
	================================================*/
	
	
	public function seleccionarEmailSuscriptores($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT nombre, email FROM $tabla");
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}
	
	/*=====  End of SELECCIONAR SUSCRIPTORES  ======*/



	/*============================================
	=            MENSAJES SIN REVISAR            =
	============================================*/
	
	
	public function mensajesSinRevisarModel($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT revision FROM $tabla");
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}
	
	/*=====  End of MENSAJES SIN REVISAR  ======*/



	/*======================================================
	=            MARCAR MENSAJES COMO REVISADOS            =
	======================================================*/
	
	
	public function mensajesRevisadosModel($datosModel, $tabla){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET revision = :revision ");
		
		$stmt -> bindParam(":revision", $datosModel, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();
	}
	
	/*=====  End of MARCAR MENSAJES COMO REVISADOS  ======*/

	
	
	
	
}