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
	
	$("#"+idArticulo).html('<form method="post" enctype="multipart/form-data"><span><input type="submit" class="btn btn-primary pull-right" value="Guardar" style="width:10%; padding:5px 0; margin-top:4px"></span><div id="editarImagen"><input style="display:none" type="file" id="subirNuevaFoto" class="btn btn-default"><div id="nuevaFoto"><span class="fa fa-times cambiarImagen"></span><img src="'+rutaImagen+'" class="img-thumbnail"></div></div><input type="text" value="'+titulo+'" name="editarTitulo"><textarea cols="30" rows="5" name="editarIntroduccion">'+introduccion+'</textarea><textarea name="editarContenido" id="editarContenido" cols="30" rows="10">'+contenido+'</textarea><input type="hidden" value="'+idArticulo+'" name="id"><input type="hidden" value="'+rutaImagen+'" name="fotoAntigua"><hr></form>')

	$(".cambiarImagen").click(function(){

		$(this).hide();
		
		$("#subirNuevaFoto").show();
		$("#subirNuevaFoto").css({"width":"80%"});
		$("#nuevaFoto").html("");
		$("#subirNuevaFoto").attr("name","editarImagen");
		$("#subirNuevaFoto").attr("require",true);

		$("#subirNuevaFoto").change(function(){

			imagen = this.files[0];
	
			//Validando el tamaño de la imagen

			imagenSize = imagen.size;

			if (Number(imagenSize)>2000000){

				$("#editarImagen").before('<div class="alert alert-warning alerta text-center">El archivo excede el tamaño permitido, 2MB</div>');
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

				$("#editarImagen").before('<div class="alert alert-warning alerta text-center">El archivo debe ser en formato JPG o PNG</div>');
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
						
						$("#nuevaFoto").html('<img src="../views/images/status.gif" style="width:15%" id="status2">');
					},
					success: function(respuesta){
						$("#status2").remove();

						if (respuesta ==0){

							$("#editarImagen").before('<div class="alert alert-warning alerta text-center">La imagen es inferior a 800px * 400px</div>');
						}
						else{

							$("#nuevaFoto").html('<img src="'+respuesta.slice(6)+'" class="img-thumbnail">');
						}	

						
					}
				})
			}
		})
	})
})

/*=====  End of EDITAR ARTICULO  ======*/



/*==============================================
=            ORDENAR ITEM ARTICULOS            =
==============================================*/

var almacenarOrdenId = new Array();
var ordenItem = new Array();

$("#ordenarArticulos").click(function(){
	
	$("#ordenarArticulos").hide();
	$("#guardarOrdenArticulos").show();

	$("#editarArticulo").css({"cursor":"move"});
	$("#editarArticulo span i").hide();
	$("#editarArticulo button").hide();
	$("#editarArticulo img").hide();
	$("#editarArticulo p").hide();
	$("#editarArticulo hr").hide();
	$("#editarArticulo div").remove();
	$(".bloqueArticulo h1").css({"font-size":"14px","position":"absolute","padding":"10px","top":"-15px"});
	$(".bloqueArticulo").css({"padding":"2px"});
	$("#editarArticulo span").html('<i class="glyphicon glyphicon-move"></i>');

	$("body, html").animate({

		scrollTop:$("body").offset().top
	},500)

	$("#editarArticulo").sortable({

		revert: true,
		connectWith: ".bloqueArticulo",
		nadle: ".handleArticle",
		stop: function (event) {
				
			for(var i = 0; i < $("#editarArticulo li").length; i++){

				almacenarOrdenId[i] = event.target.children[i].id;
				ordenItem[i] = i+1;
				
				
			}
		}
	})


	$("#guardarOrdenArticulos").click(function(){
		
		$("#guardarOrdenArticulos").hide();
		$("#ordenarArticulos").show();

		for(var i = 0; i < $("#editarArticulo li").length; i++){

				var actualizarOrden = new FormData();
				actualizarOrden.append("actualizarOrdenArticulos", almacenarOrdenId[i]);
				actualizarOrden.append("actualizarOrdenItem", ordenItem[i]);

				$.ajax({

					url: "views/ajax/gestorArticulos.php",
					method: "POST",
					data: actualizarOrden,
					cache: false,
					contentType: false,
					processData: false,
					success: function(respuesta){

						$("#editarArticulo").html(respuesta);
						
						swal({
							title: "¡OK!",
							text: "¡El orden se ha actualizado correctamente!",
							type: "success",
							confirmButtonText: "Cerrar",
							closeOnConfirm: false},
							function(isConfirm){
								if (isConfirm){
									window.location = "articulos";
								}
							});
					}
				})
			}

	});
	
});

/*=====  End of ORDENAR ITEM ARTICULOS  ======*/
	
