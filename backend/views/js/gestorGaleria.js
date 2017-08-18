/*====================================================
=            AREA DE ARRASTRE DE IMAGENES            =
====================================================*/


if ($("#lightbox").html() == 0) {

	$("#lightbox").css({"height":"100px"});
}
else{

	$("#lightbox").css({"height":"auto"});
}

/*=====  End of AREA DE ARRASTRE DE IMAGENES  ======*/



/*================================================
=            SUBIR MULTIPLES IMAGENES            =
================================================*/

//evitar propagacion en body
$("body").on("dragover", function(e){

	e.preventDefault();
	e.stopPropagation();
});

//Cambiar imagen de fondo al arrastrar una imagen sobre el area de arrastre
$("#lightbox").on("dragover", function(e){

	e.preventDefault();
	e.stopPropagation();

	$("#lightbox").css({"background":"url(views/images/pattern.jpg)"});

});

//evitar propagacion en body
$("body").on("drop", function(e){

	e.preventDefault();
	e.stopPropagation();
});

//soltar imagenes

var imagenSize = [];
var imagenType = [];

$("#lightbox").on("drop", function(e){

	e.preventDefault();
	e.stopPropagation();

	$("#lightbox").css({"background":"white"});

	//Recibiendo la imagen en una variable
	var archivo = e.originalEvent.dataTransfer.files;
	
	for(var i = 0; i < archivo.length; i++){

		imagen = archivo[i];
		imagenSize.push(imagen.size);
		imagenType.push(imagen.type);
		
		//Validando peso de las imagenes
		if(Number(imagenSize[i]) > 2000000){

		$(".alerta").remove();
		$("#lightbox").before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido, 2mb</div>');
		}
		else{

			$(".alerta").remove();
		}

		//Validando tipo de imagenes
		if (imagenType[i] == "image/jpeg" || imagenType == "image/png") {

			$(".alerta2").remove();
		}
		else{

			$(".alerta2").remove();
			$("#lightbox").before('<div class="alert alert-warning alerta2 text-center">El archivo debe ser formato JPG o PNG.</div>');
		}

		//Subir imagen al servidor

		if (Number(imagenSize[i])< 2000000 && imagenType[i] == "image/jpeg" || imagenType[i] == "image/png"){

			var datos = new FormData();

			datos.append("imagen", imagen);

			$.ajax({

				url: 'views/ajax/gestorGaleria.php',
				type: 'POST',
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function(){

					$("#lightbox").append('<li id="status"><img src="../views/images/status.gif"></li>');
				},
				success: function(respuesta){
					
					$("#status").remove();

					if (respuesta == 0 ) {
											
						$(".alerta2").remove();
						$("#lightbox").before('<div class="alert alert-warning alerta2 text-center">El tamaño de la imagen es inferior 1024px * 768px.</div>');
					}
					else{

						$("#lightbox").css({"height":"auto"});

						$("#lightbox").append('<li><span class="fa fa-times"></span><a rel="grupo" href="'+respuesta.slice(6)+'"><img src="'+respuesta.slice(6)+'"></a></li>');

						swal({
							title: "¡OK!",
							text: "¡La imagen se subio corectamente!",
							type: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						},

						function(isConfirm){
							if(isConfirm){
								window.location = "galeria";
							}
						});
					}
				}			


			})

		}		


	}
});

/*=====  End of SUBIR MULTIPLES IMAGENES  ======*/

$(".eliminarFoto").click(function(){

	if ($(".eliminarFoto").length == 1){

		$("#lightbox").css({"height":"100px"});
	}

	idGaleria = $(this).parent().attr("id");
	rutaGaleria = $(this).attr("ruta");
	
	$(this).parent().remove();

	var borrarItem = new FormData();

	borrarItem.append("idGaleria", idGaleria);
	borrarItem.append("rutaGaleria", rutaGaleria);

	$.ajax({

		url: 'views/ajax/gestorGaleria.php',
		type: 'POST',
		data: borrarItem,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			console.log("respuesta", respuesta);


		}


	});

});
