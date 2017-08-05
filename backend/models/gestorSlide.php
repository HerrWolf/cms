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

		$stmt = Conexion::conectar()->prepare("SELECT id, ruta, titulo, descripcion FROM $tabla ORDER BY orden ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}

	/*=====  End of MOSTRAR IMAGENES EN VIEWS  ======*/



	/*===============================================
	=            ELIMINAR ITEM DEL SLIDE            =
	===============================================*/
	
	
	public function eliminarSlideModel($datos, $tabla){
		
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos["idSlide"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();
	}
	
	/*=====  End of ELIMINAR ITEM DEL SLIDE  ======*/



	/*=============================================
	=            ACTUALIZAR ITEM SLIDE            =
	=============================================*/
	
	
	public function actualizarSlideModel($datos,$tabla){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo, descripcion = :descripcion WHERE id = :id ");

		$stmt -> bindParam(":titulo", $datos["enviarTitulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":descripcion", $datos["enviarDescripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["enviarId"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();	
	}
	
	/*=====  End of ACTUALIZAR ITEM SLIDE  ======*/



	/*============================================================
	=            SELECCIONAR ACTUALIZACION ITEM SLIDE            =
	============================================================*/
	
	
	public function seleccionarActualizacionSlideModel($datos, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT titulo, descripcion FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos["enviarId"], PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt->close();
	}
	
	/*=====  End of SELECCIONAR ACTUALIZACION ITEM SLIDE  ======*/
	
	
	
	
	
}