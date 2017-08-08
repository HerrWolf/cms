$("#btnAgregarArticulo").click(function (){
	
	$("#agregarArticulo").toggle(400);
})


/*=======================================================
=            SUBIR IMAGEN A TRAVES DEL INPUT            =
=======================================================*/

$("#subirFoto").change(function () {
	
	imagen = this.files[0];
	
	//Validando el tamaño de la imagen

	imagenSize = imagen.size;

	if (Number(imagenSize)>2000000){

		$("#arrastreImagenArticulo").before('<div class="alert alert-warning alerta text-center">El archivo excede el tamaño permitido, 2MB</div>');
	}
	else{

		$(".alerta").remove();
	}

	//Validar tipo de imagen

	imagenType = imagen.type;

	if (imagenType == "image/jpeg" || imagenType == "image/png"){

		$(".alerta").remove();
	}
	else{

		$("#arrastreImagenArticulo").before('<div class="alert alert-warning alerta text-center">El archivo debe ser en formato JPG o PNG</div>');
	}


	//Mostrar imagen con AJAX

	if (Number(imagenSize)< 2000000 && imagenType == "image/jpeg" || imagenType == "image/png"){

		var datos = new FormData;

		datos.append("imagen", imagen);

		$ajax({

			url: "views/ajax/gestorArticulos.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function(){
				
				$("#arrastreImagenArticulo").before('<img src="views/images/status.gif" id="status">');
			},
			success: function(respuesta){
				console.log("respuesta", respuesta);

				
			}
		})
	}

})


/*=====  End of SUBIR IMAGEN A TRAVES DEL INPUT  ======*/
