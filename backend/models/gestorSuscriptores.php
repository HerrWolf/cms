<?php 

require_once "conexion.php";

class SuscriptoresModel{


	/*=================================================
	=            MOSTRAR SUSCRIPTORES VIEW            =
	=================================================*/
	
	
	public function mostrarSuscriptoresModel($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT id, nombre, email FROM $tabla");
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}
	
	/*=====  End of MOSTRAR SUSCRIPTORES VIEW  ======*/



	/*===========================================
	=            BORRAR SUSCRIPTORES            =
	===========================================*/
	
	
	public function borrarSuscriptoresModel($datosModel, $tabla){
		
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
	
	/*=====  End of BORRAR SUSCRIPTORES  ======*/



	/*=================================================
	=            IMPRIMIR SUSCRIPTORES PDF            =
	=================================================*/
	
	
	public function impresionSuscriptoresModel($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT nombre, email FROM $tabla");
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}
	
	/*=====  End of IMPRIMIR SUSCRIPTORES PDF  ======*/



	/*===================================================
	=            REVISAR SUSCRIPTORES NUEVOS            =
	===================================================*/
	
	
	public function suscriptoresSinRevisarModel($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT revision FROM $tabla");
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}
	
	/*=====  End of REVISAR SUSCRIPTORES NUEVOS  ======*/
	
	
	
	
}