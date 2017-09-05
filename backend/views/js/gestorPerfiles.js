//Aparecer el formulario de registro al dar click en el boton
$("#registrarPerfil").click(function (){
	
	$("#formularioPerfil").toggle(400);
})

//Detectar si hay cambio en el input file para subir imagen de perfil
$("#subirFotoPerfil").change(function(){
	
	$("#subirFotoPerfil").attr("name","nuevaImagen");

});

/*========================================================
=            MOSTRAR FORMULARIO EDITAR PERFIL            =
========================================================*/


$("#btnEditarPerfil").click(function(){

	$("#editarPerfil").hide("fast");
	$("#formEditarPerfil").show("fast");

})

$("#cambiarFotoPerfil").change(function(){

	$("#cambiarFotoPerfil").attr("name","editarImagen")

});

/*=====  End of MOSTRAR FORMULARIO EDITAR PERFIL  ======*/
