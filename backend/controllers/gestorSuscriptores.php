<?php 

class SuscriptoresController{


	/*====================================================
	=            MOSTRAR SUSCRIPTORES EN VIEW            =
	====================================================*/
	
	
	public function mostrarSuscriptoresController(){
		
		$respuesta = SuscriptoresModel::mostrarSuscriptoresModel("suscriptores");

		foreach ($respuesta as $row => $item) {
			
			echo '<tr>
			          <td>'.$item["nombre"].'</td>
			          <td>'.$item["email"].'</td>
			          <td><a href="index.php?action=suscriptores&idBorrar='.$item["id"].'"><span class="btn btn-danger fa fa-times quitarSuscriptor"></span></a></td>
			          <td></td>
		          </tr>';
		}
	}
	
	/*=====  End of MOSTRAR SUSCRIPTORES EN VIEW  ======*/



	/*===========================================
	=            BORRAR SUSCRIPTORES            =
	===========================================*/
	
	
	public function borrarSuscriptoresController(){
		
		if (isset($_GET["idBorrar"])) {

			$datosController = $_GET["idBorrar"];

			$respuesta = SuscriptoresModel::borrarSuscriptoresModel($datosController, "suscriptores");

			if ($respuesta == "ok") {
				
				echo '<script>

						swal({
							title: "¡OK!",
							text: "¡El suscriptor se ha borrado correctamente!",
							type: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
							},

						function(isConfirm){
							if(isConfirm){
								window.location = "suscriptores";
							}
						});
				
					 </script>';
			}
		}
	}
	
	/*=====  End of BORRAR SUSCRIPTORES  ======*/



	/*=================================================
	=            IMPRIMIR SUSCRIPTORES PDF            =
	=================================================*/
	
	#Se puede usar el metodo mostrarSuscriptoresModel() para no crear el metodo impresionSuscriptoresModel() 
	public function impresionSuscriptoresController($datos){

		$datosController = $datos;
		
		$respuesta = SuscriptoresModel::impresionSuscriptoresModel($datosController);

		return $respuesta;
	}
	
	/*=====  End of IMPRIMIR SUSCRIPTORES PDF  ======*/



	/*===================================================
	=            REVISAR SUSCRIPTORES NUEVOS            =
	===================================================*/
	
	
	public function suscriptoresSinRevisarController(){
		
		$respuesta = SuscriptoresModel::suscriptoresSinRevisarModel("suscriptores");

		$sumaRevision = 0;

		foreach ($respuesta as $row => $item) {
			
			if ($item["revision"] == 0) {
				
				++$sumaRevision;

				echo '<span>'.$sumaRevision.'</span>';
			}

		}
	}
	
	/*=====  End of REVISAR SUSCRIPTORES NUEVOS  ======*/



	/*==========================================================
	=            MARCAR SUSCRIPTORES COMO REVISADOS            =
	==========================================================*/
	
	
	public function suscriptoresRevisadosController($datos){
		
		$datosController = $datos;
		
		$respuesta = SuscriptoresModel::suscriptoresRevisadosModel($datosController, "suscriptores");

		echo $respuesta;
	}
	
	/*=====  End of MARCAR SUSCRIPTORES COMO REVISADOS  ======*/
	
	
	
	
	
}
