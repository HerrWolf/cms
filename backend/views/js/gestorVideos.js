/*====================================================
=            AREA DE ARRASTRE DE IMAGENES            =
====================================================*/


if ($("#galeriaVideo").html() == 0) {

	$("#galeriaVideo").css({"height":"100px"});
}
else{

	$("#galeriaVideo").css({"height":"auto"});
}

/*=====  End of AREA DE ARRASTRE DE IMAGENES  ======*/



/*===================================
=            SUBIR VIDEO            =
===================================*/


$("#subirVideo").change(function(){

	video = this.files[0];

	//Validar tamaño del video

	videoSize = video.size;

	if (Number(videoSize)>50000000){

		$("#galeriaVideo").before('<div class="alert alert-warning alerta text-center">El archivo excede el tamaño permitido, 2MB</div>');
	}
	else{

		$(".alerta").remove();
	}

	//Validar tipo de video

	videoType = video.type;

	if (videoType == "video/mp4"){

		$(".alerta").remove();
	}
	else{

		$("#galeriaVideo").before('<div class="alert alert-warning alerta text-center">El archivo debe ser en formato MP4</div>');
	}

	//Mostrar video con AJAX

	if (Number(videoSize)< 50000000 && videoType == "video/mp4"){

		var datos = new FormData;

		datos.append("video", video);

		$.ajax({

			url: "views/ajax/gestorVideos.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function(){
				
				$("#galeriaVideo").before('<img src="../views/images/status.gif" id="status">');
			},
			success: function(respuesta){

				$("#status").remove();

				$("#galeriaVideo").css({"height":"auto"});

				$("#galeriaVideo").append('<li><span class="fa fa-times"></span><video controls><source src="'+respuesta.slice(6)+'" type="video/mp4"></video></li>');

				swal({
						title: "¡OK!",
						text: "¡El video se subio corectamente!",
						type: "success",
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					},

					function(isConfirm){
						if(isConfirm){
							window.location = "videos";
						}
					});
			}				
		})
	}


})

/*=====  End of SUBIR VIDEO  ======*/



/*======================================
=            ELIMINAR VIDEO            =
======================================*/


$(".eliminarVideo").click(function(){

	if ($(".eliminarVideo").length == 1){

		$("#galeriaVideo").css({"height":"100px"});
	}

	idVideo = $(this).parent().attr("id");
	rutaVideo = $(this).attr("ruta");
	
	//eliminar el <li> que contiene el video
	$(this).parent().remove();

	var borrarVideo = new FormData;

	borrarVideo.append("idVideo", idVideo);
	borrarVideo.append("rutaVideo", rutaVideo);

	$.ajax({

		url: "views/ajax/gestorVideos.php",
		method: "POST",
		data: borrarVideo,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta){
			
		}				
	})

});

/*=====  End of ELIMINAR VIDEO  ======*/



/*======================================
=            ORDENAR VIDEOS            =
======================================*/

var almacenarOrdenId = new Array();
var ordenItem = new Array();

$("#ordenarVideo").click(function(){
	
	//ocultar boton ordenar
	$("#ordenarVideo").hide();
	//mostrar boton guardar
	$("#guardarVideo").show();

	//Cambiar apariencia dl cursor
	$("#galeriaVideo").css({"cursor":"move"});
	//ocultar los span de eliminar imagen
	$("#galeriaVideo span").hide();

	$("#galeriaVideo").sortable({
		//esto sirve para que la imagen regrese si se pone en un lugar no valido
		revert: true,
		//esto sirve para que la imagen se enganche a una posicion en el <li>
		connectWith: ".bloqueVideo",
		//esto sirve para poder arrastar la imagen
		handle: ".handleVideo",
		stop: function(event){

			for (var i=0; i < $("#galeriaVideo li").length; i++) {
				almacenarOrdenId[i] = event.target.children[i].id;
				ordenItem[i] = i+1;
				
			}
		}
	});


})

$("#guardarVideo").click(function (){
	
	//ocultar boton guardar
	$("#guardarVideo").hide();
	//mostrar boton ordenar
	$("#ordenarVideo").show();

	for (var i=0; i < $("#galeriaVideo li").length; i++) {

		var actualizarOrden = new FormData();
		actualizarOrden.append("actualizarOrdenVideo", almacenarOrdenId[i]);
		actualizarOrden.append("actualizarOrdenItem", ordenItem[i]);

		$.ajax({

			url: 'views/ajax/gestorVideos.php',
			type: 'POST',
			data: actualizarOrden,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta){
				
				$("#galeriaVideo").html(respuesta);

				swal({
						title: "¡OK!",
						text: "¡El orden se ha actualizaco correctamente!",
						type: "success",
						confirmButtonText: "Cerrar",
						closeOnConfirm: false
					},

					function(isConfirm){
						if(isConfirm){
							window.location = "videos";
						}
					});				
			}
		})
	}


})

/*=====  End of ORDENAR VIDEOS  ======*/


