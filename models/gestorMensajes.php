<?php 

require_once "backend/models/conexion.php";

class MensajesModel{

	public function registroMensajesModel($datos, $tabla){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre, email, mensaje) VALUES(:nombre, :email, :mensaje)");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";
		}

		else{

			"error";
		}

		$stmt->close();
	}
}