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

		$.ajax({

			url: "views/ajax/gestorArticulos.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function(){
				
				$("#arrastreImagenArticulo").before('<img src="../views/images/status.gif" id="status">');
			},
			success: function(respuesta){
				$("#status").remove();

				if (respuesta ==0){

					$("#arrastreImagenArticulo").before('<div class="alert alert-warning alerta text-center">La imagen es inferior a 800px * 400px</div>');
				}
				else{

					$("#arrastreImagenArticulo").html('<div id="imagenArticulo"><img src="'+respuesta.slice(6)+'" class="img-thumbnail"></div>');
				}	

				
			}
		})
	}

})


/*=====  End of SUBIR IMAGEN A TRAVES DEL INPUT  ======*/



/*=======================================
=            EDITAR ARTICULO            =
=======================================*/


$(".editarArticulo").click(function(){
	
	idArticulo = $(this).parent().parent().attr("id");
	rutaImagen = $("#"+idArticulo).children("img").attr("src");
	titulo = $("#"+idArticulo).children("h1").html();
	introduccion = $("#"+idArticulo).children("p").html();
	contenido = $("#"+idArticulo).children("input").val();	
	
	$("#"+idArticulo).html('<form method="post" enctype="multipart/form-data"><span><button class="btn btn-primary pull-right">Guardar</button></span><div id="editarImagen"><input style="display:none" type="file" id="subirNuevaFoto" class="btn btn-default" style="color:transparent"><div id="nuevaFoto"><span class="fa fa-times cambiarImagen"></span><img src="'+rutaImagen+'" class="img-thumbnail"></div></div><input type="text" value="'+titulo+'" name="editarTitulo"><textarea cols="30" rows="5" name="editarIntroduccion">'+introduccion+'</textarea><textarea name="editarContenido" id="editarContenido" cols="30" rows="10">'+contenido+'</textarea><hr></form>')

	$(".cambiarImagen").click(function(){

		$(this).hide();
		
		$("#subirNuevaFoto").show();
		$("#subirNuevaFoto").css({"width":"90%"});
		$("#nuevaFoto").html("");
	})
})

/*=====  End of EDITAR ARTICULO  ======*/
