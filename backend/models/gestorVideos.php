<?php

require_once "conexion.php";

class GestorVideosModel{

	/*===============================================
	=            SUBIR LA RUTA DEL VIDEO            =
	===============================================*/
	
	

	public function subirVideoModel($datos, $tabla){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (ruta) VALUES(:ruta)");

		$stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();

	}
	
	/*=====  End of SUBIR LA RUTA DEL VIDEO  ======*/



	/*=============================================
	=           MOSTRAR VIDEO CON AJAX            =
	=============================================*/
	
	
	public function mostrarVideoModel($datos, $tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT ruta FROM $tabla WHERE ruta = :ruta");

		$stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);
		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt->close();
	}
	
	/*=====  End of MOSTRAR VIDEO CON AJAX  ======*/



	/*==============================================
	=           MOSTRAR VIDEOS EN VIEWS            =
	==============================================*/
	
	
	public function mostrarVideoVistaModel($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT id, ruta FROM $tabla ORDER BY orden ASC");
				
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}
	
	/*=====  End of MOSTRAR VIDEOS EN VIEWS ======*/



	/*======================================
	=            ELIMINAR VIDEO            =
	======================================*/
	
	
	public function eliminarVideoModel($datos, $tabla){
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos["idVideo"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();
	}
	
	/*=====  End of ELIMINAR VIDEO  ======*/
	
	
	
	
}