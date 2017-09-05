<?php 

session_start();

if (!$_SESSION["validar"]) {
  
  header("location:ingreso");

  exit();
}

include "views/modules/botonera.php";
include "views/modules/cabezote.php";

 ?>

 <!--=====================================
PERFIL       
======================================-->

<div id="editarPerfil" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
 
	<h1>Hola <?php echo $_SESSION["usuario"]; ?> 
	<span class="btn btn-info fa fa-pencil pull-left" id="btnEditarPerfil" style="font-size:10px; margin-right:10px"></span></h1>

	<div style="position:relative">
	<img src="<?php echo $_SESSION["photo"]; ?>" class="img-circle pull-right">	
	</div>

	<hr>

	<h4>Perfil: 
    <?php

      if ($_SESSION["rol"] == 0) {
        
        echo "Administrador";

      }
      else{

        echo "Editor";

      }

    ?>
    
  </h4>

	<h4>Email: <?php echo $_SESSION["email"]; ?></h4>

	<h4>Contraseña: *******</h4>

</div>

<!-- FORMULARIO EDITAR PERFIL -->

<div id="formEditarPerfil" style="display: none" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
  
  <form style="padding: 20px" method="post" enctype="multipart/form-data">

    <input type="hidden" name="idPerfil" value="<?php echo $_SESSION["id"]; ?>">
    
    <div class="form-group">
      
      <input type="text" name="editarUsuario" class="form-control" value="<?php echo $_SESSION["usuario"]; ?>" required>

    </div>

    <div class="form-group">
      
      <input type="password" name="editarPassword" placeholder="Ingrese la contraseña hasta 10 caracteres" maxlength="10" class="form-control" required>

    </div>

    <div class="form-group">
      
      <input type="email" name="editarEmail" class="form-control" value="<?php echo $_SESSION["email"]; ?>" required>

    </div>

    <div class="form-group">
      
      <select name="editarRol" class="form-control">

        <option value="">Seleccione el Rol</option>
        <option value="0">Administrador</option>
        <option value="1">Editor</option>

      </select>

    </div>

    <div class="form-group text-center">

          <img src="<?php echo $_SESSION["photo"]; ?>" width="20%" class="img-circle">

           <input type="hidden" value="<?php echo $_SESSION["photo"]; ?>" name="editarPhoto">
         
          <input type="file" class="btn btn-default" id="cambiarFotoPerfil" style="display:inline-block; margin:10px 0">

          <p class="text-center" style="font-size:12px">Tamaño recomendado de la imagen: 100px * 100px, peso máximo 2MB</p>

       </div>

    <input type="submit" id="guardarPerfil" value="Actualizar Perfil" class="btn btn-primary">

  </form>

</div>


<!-- FIN FORMULARIO EDITAR PERFIL -->

<div id="crearPerfil" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
 
	

	<button id="registrarPerfil" style="margin-bottom: 20px" class="btn btn-default">Registrar un nuevo miembro</button>


  <!-- FORMULARIO CREAR PERFIL -->


  <form id="formularioPerfil" style="display: none" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
      
      <input type="text" name="nuevoUsuario" placeholder="Ingrese nombre de usuarios hasta 10 caracteres" maxlength="10" class="form-control" required>

    </div>

    <div class="form-group">
      
      <input type="password" name="nuevoPassword" placeholder="Ingrese la contraseña hasta 10 caracteres" maxlength="10" class="form-control" required>

    </div>

    <div class="form-group">
      
      <input type="email" name="nuevoEmail" placeholder="Ingrese el correo electronico" class="form-control" required>

    </div>

    <div class="form-group">
      
      <select name="nuevoRol" class="form-control">

        <option value="">Seleccione el Rol</option>
        <option value="0">Administrador</option>
        <option value="1">Editor</option>

      </select>

    </div>

    <div class="form-group text-center">
      
      <input type="file" class="btn btn-default" id="subirFotoPerfil" style="display: inline-block; margin: 10px 0">
      <p class="text-center" style="font-size: 12px">Tamaño recomendado de la imagen 100px * 100px, peso maximo 2MB</p>

    </div>

    <input type="submit" id="guardarPerfil" value="Guardar Perfil" class="btn btn-primary">

  </form>

  <!-- FIN FORMULARIO CREAR PERFIL -->

  <?php

    $crearPerfil = new GestorPerfiles();
    $crearPerfil -> guardarPerfilController();
    $crearPerfil -> editarPerfilController();

  ?>

	<hr>

	<div class="table-responsive">

	<table id="tablaSuscriptores" class="table table-striped display">
    <thead>
      <tr>
        <th>Usuario</th>
        <th>Perfil</th>
        <th>Email</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

      <?php

        $verPerfiles = new GestorPerfiles();
        $verPerfiles -> verPerfilesController();

      ?>
      
    </tbody>
  </table>

  </div>
</div>


<!--====  Fin de PERFIL  ====-->

