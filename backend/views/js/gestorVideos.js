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

