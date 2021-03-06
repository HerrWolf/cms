<?php 

require_once "conexion.php";

class GestorArticulosModel{
	
	/*==============================================
	=            GUARDAR ARTICULO EN DB            =
	==============================================*/
	
	
	public function guardarArticuloModel($datosModel,$tabla){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (titulo, introduccion, ruta, contenido) VALUES(:titulo, :introduccion, :ruta, :contenido)");

		$stmt -> bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":introduccion", $datosModel["introduccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":ruta", $datosModel["ruta"], PDO::PARAM_STR);
		$stmt -> bindParam(":contenido", $datosModel["contenido"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();
	}
	
	/*=====  End of GUARDAR ARTICULO EN DB  ======*/



	/*=================================================
	=            MOSTRAR ARTICULOS EN VIEW            =
	=================================================*/
	
	
	public function mostrarArticulosModel($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT id, titulo, introduccion, ruta, contenido FROM $tabla ORDER BY orden ASC");
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();
	}
	
	/*=====  End of MOSTRAR ARTICULOS EN VIEW  ======*/



	/*=============================================
	=            BORRAR ARTICULO DE DB            =
	=============================================*/
	
	public function borrarArticuloModel($datosModel, $tabla){
		
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

	
	/*=====  End of BORRAR ARTICULO DE DB  ======*/



	/*=============================================
	=            EDITAR ARTICULO EN DB            =
	=============================================*/
	
	
	public function editarArticuloModel($datosModel, $tabla){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET titulo = :titulo, introduccion = :introduccion, ruta = :ruta, contenido = :contenido WHERE id = :id ");

		$stmt -> bindParam(":titulo", $datosModel["titulo"], PDO::PARAM_STR);
		$stmt -> bindParam(":introduccion", $datosModel["introduccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":ruta", $datosModel["ruta"], PDO::PARAM_STR);
		$stmt -> bindParam(":contenido", $datosModel["contenido"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();	
	}
	
	/*=====  End of EDITAR ARTICULO EN DB  ======*/



	/*==============================================
	=            ACTUALIZAR ORDEN EN DB            =
	==============================================*/
	
	

	public function actualizarOrdenModel($datos, $tabla){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET orden = :orden WHERE id = :id");

		$stmt -> bindParam(":orden", $datos["ordenItem"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["ordenArticulos"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();
	}
	
	/*=====  End of ACTUALIZAR ORDEN EN DB  ======*/



	/*=========================================
	=            SELECCIONAR ORDEN            =
	=========================================*/
	
	
	public function seleccionarOrdenModel($tabla){
		
		$stmt = Conexion::conectar()->prepare("SELECT id, titulo, introduccion, ruta, contenido FROM $tabla ORDER BY orden ASC");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt->close();

	}
	
	/*=====  End of SELECCIONAR ORDEN  ======*/
	
	




	
	
	
	
}