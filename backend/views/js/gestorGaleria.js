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
		imagenSize.push(imagen.type);
	}
});

/*=====  End of SUBIR MULTIPLES IMAGENES  ======*/
