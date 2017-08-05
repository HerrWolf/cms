/*====================================================
=            AREA DE ARRASTRE DE IMAGENES            =
====================================================*/


if ($("#columnasSlide").html() == 0) {

	$("#columnasSlide").css({"height":"100px"});
}
else{

	$("#columnasSlide").css({"height":"auto"});
}

/*=====  End of AREA DE ARRASTRE DE IMAGENES  ======*/

/*====================================
=            SUBIR IMAGEN            =
====================================*/


$("#columnasSlide").on("dragover", function(e){

	e.preventDefault();
	e.stopPropagation();

	$("#columnasSlide").css({"background":"url(views/images/pattern.jpg)"});

});

/*=====  End of SUBIR IMAGEN  ======*/

/*=====================================
=            SOLTAR IMAGEN            =
=====================================*/

$("#columnasSlide").on("drop", function(e){

	e.preventDefault();
	e.stopPropagation();

	$("#columnasSlide").css({"background":"white"});

	//Recibiendo la imagen en una variable
	var archivo = e.originalEvent.dataTransfer.files;
	var imagen = archivo[0];

	//Validando el peso de la imagen
	var imagenSize = imagen.size;

	if(Number(imagenSize) > 2000000){

		$(".alerta").remove();
		$("#columnasSlide").before('<div class="alert alert-warning alerta text-center">El archivo excede el peso permitido, 2mb</div>');
	}
	else{

		$(".alerta").remove();
	}

	//validando tipo de archivo
	var imagenType = imagen.type;
		
	if (imagenType == "image/jpeg" || imagenType == "image/png") {

		$(".alerta2").remove();
	}
	else{

		$(".alerta2").remove();
		$("#columnasSlide").before('<div class="alert alert-warning alerta2 text-center">El archivo debe ser formato JPG o PNG.</div>');
	}

	//Subir imagen al servidor

	if (Number(imagenSize)< 2000000 && imagenType == "image/jpeg" || imagenType == "image/png"){

		var datos = new FormData();

		datos.append("imagen", imagen);

		$.ajax({

			url: 'views/ajax/gestorSlide.php',
			type: 'POST',
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			beforeSend: function(){

				$("#columnasSlide").before('<img src="../views/images/status.gif" id="status">');
			},
			success: function(respuesta){

				$("#status").remove();
				
				if (respuesta == 0 ) {
											
					$(".alerta2").remove();
					$("#columnasSlide").before('<div class="alert alert-warning alerta2 text-center">El tamaño de la imagen es inferior 1600px * 600px.</div>');
				}
				else{

					$("#columnasSlide").css({"height":"auto"});

					$("#columnasSlide").append('<li class="bloqueSlide"><span class="fa fa-times"></span><img src="'+respuesta["ruta"].slice(6)+'" class="handleImg"></li>');

					$("#ordenarTextSlide").append('<li><span class="fa fa-pencil" style="background:blue"></span><img src="'+respuesta["ruta"].slice(6)+'" style="float:left; margin-bottom:10px" width="80%"><h1>'+respuesta["titulo"]+'</h1><p>'+respuesta["descripcion"]+'</p></li>');

					swal({
						title: "¡OK!",
						text: "¡La imagen se subio corectamente!",
						type: "success",
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					},

					function(isConfirm){
						if(isConfirm){
							window.location = "slide";
						}
					});
				}

			}
		});

	}
	



});

/*=====  End of SOLTAR IMAGEN  ======*/



/*===========================================
=            ELIMINAR ITEM SLIDE            =
===========================================*/


$(".eliminarSlide").click(function() {

	//Regresando el area de carga de imagenes a un tamaño de 100px cuando se quede vacia
	if ($(".eliminarSlide").length == 1){

		$("#columnasSlide").css({"height":"100px"});
	}
	
	// eliminar item en la vista
	idSlide = $(this).parent().attr("id");
	rutaSlide = $(this).attr("ruta");

	$(this).parent().remove();
	$("#item"+idSlide).remove();

	//eliminar item en base de datos con ajax
	var borrarItem = new FormData();

	borrarItem.append("idSlide", idSlide);
	borrarItem.append("rutaSlide", rutaSlide);

	$.ajax({

		url: 'views/ajax/gestorSlide.php',
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

/*=====  End of ELIMINAR ITEM SLIDE  ======*/



/*=========================================
=            EDITAR ITEM SLIDE            =
=========================================*/


$(".editarSlide").click(function(){

	idSlide = $(this).parent().attr("id");
	rutaImagen = $(this).parent().children("img").attr("src");
	rutaTitulo = $(this).parent().children("h1").html();
	rutaDescripcion = $(this).parent().children("p").html();
	
	$(this).parent().html('<img src="'+rutaImagen+'" class="img-thumbnail"><input type="text" class="form-control" placeholder="Título" value="'+rutaTitulo+'" id="enviarTitulo"><textarea row="5" class="form-control" placeholder="Descripción" id="enviarDescripcion">'+rutaDescripcion+'</textarea><button class="btn btn-info pull-right" style="margin:10px" id="guardar'+idSlide+'">Guardar</button>');

	$("#guardar"+idSlide).click(function (){
		
		enviarId = idSlide.slice(4);
		
		enviarTitulo = $("#enviarTitulo").val();
		enviarDescripcion = $("#enviarDescripcion").val();

		var actualizarSlide = new FormData();

		actualizarSlide.append("enviarId",enviarId);
		actualizarSlide.append("enviarTitulo",enviarTitulo);
		actualizarSlide.append("enviarDescripcion",enviarDescripcion);

		$.ajax({

			url: 'views/ajax/gestorSlide.php',
			type: 'POST',
			data: actualizarSlide,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta){
				
				$("#guardar"+idSlide).parent().html('<span class="fa fa-pencil editarSlide" style="background:blue"></span><img src="'+rutaImagen+'" style="float:left; margin-bottom:10px" width="80%"><h1>'+respuesta["titulo"]+'</h1><p>'+respuesta["descripcion"]+'</p>');

				swal({
						title: "¡OK!",
						text: "¡Se han guarado los cambios correctamente!",
						type: "success",
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					},

					function(isConfirm){
						if(isConfirm){
							window.location = "slide";
						}
					});

			}
		});
	});
});

/*=====  End of EDITAR ITEM SLIDE  ======*/



