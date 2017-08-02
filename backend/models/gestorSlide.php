<?php

require_once "conexion.php";

class GestorSlideModel{

	/*====================================================
	=            SUBIR RUTA DE IMAGEN A LA DB            =
	====================================================*/
	
	
	public function subirImagenSlideModel($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (ruta) VALUES (:ruta)");
		
		$stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);
		
		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();

	}

	/*=====  End of SUBIR RUTA DE IMAGEN A LA DB  ======*/



	/*=======================================================
	=            MOSTRAR IMAGEN DESPUES DEL DROP            =
	=======================================================*/
	
	
	public function mostrarImagenSlideModel($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT ruta, titulo, descripcion FROM $tabla WHERE ruta = :ruta");

		$stmt -> bindParam(":ruta", $datos, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt->close();
	}
	
	/*=====  End of MOSTRAR IMAGEN DESPUES DEL DROP  ======*/



	/*=================================================
	=            MOSTRAR IMAGENES EN VIEWS            =
	=================================================*/
	
	
	public function mostrarImagenVistaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT ruta, titulo, descripcion FROM $tabla ORDER BY orden ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}

	/*=====  End of MOSTRAR IMAGENES EN VIEWS  ======*/
	
	
}