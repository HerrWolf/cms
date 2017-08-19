<?php

require_once "conexion.php";

class GestorGaleriaModel{

	/*=======================================================
	=            SUBIR RUTA DE LA IMAGEN A LA DB            =
	=======================================================*/
	
	
	public function subirImagenGaleriaModel($datos, $tabla){
		
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
	
	/*=====  End of SUBIR RUTA DE LA IMAGEN A LA DB  ======*/



	/*=======================================================
	=            MOSTRAR IMAGEN DESPUES DEL DROP            =
	=======================================================*/
	
	
	public function mostrarImagenGaleriaModel($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT ruta FROM $tabla WHERE ruta = :ruta");

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

		$stmt = Conexion::conectar()->prepare("SELECT id, ruta FROM $tabla ORDER BY orden ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}

	/*=====  End of MOSTRAR IMAGENES EN VIEWS  ======*/



	/*===================================================
	=            ELIMINAR ITEM DE LA GALERIA            =
	===================================================*/
	
	
	public function eliminarGaleriaModel($datos, $tabla){
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos["idGaleria"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();
	}
	
	/*=====  End of ELIMINAR ITEM DE LA GALERIA  ======*/



	/*========================================
	=            ACTUALIZAR ORDEN            =
	========================================*/
	
	
	public function actualizarOrdenModel($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");

		$stmt -> bindParam(":orden", $datos["ordenItem"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["ordenGaleria"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();	
	}
	
	/*=====  End of ACTUALIZAR ORDEN  ======*/



	/*=========================================
	=            SELECCIONAR ORDEN            =
	=========================================*/
	
	
	public function seleccionarOrdenModel($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT id, ruta FROM $tabla ORDER BY orden ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}
	
	/*=====  End of SELECCIONAR ORDEN  ======*/
	
	
}