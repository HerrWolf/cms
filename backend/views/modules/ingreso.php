<div id="backIngreso">

	<form method="post" id="formIngreso" onsubmit="return validarIngreso()">

		<h1 id="tituloFormIngreso">INGRESO AL PANEL DE CONTROL</h1>
		
		<input class="form-control formIngreso" type="text" placeholder="Ingrese su Usuario" name="usuarioIngreso" id="usuarioIngreso" required>
		<input class="form-control formIngreso" type="password" placeholder="Ingrese su Contraseña" name="passwordIngreso" id="passwordIngreso" required>
		<?php 

			 $ingreso = new Ingreso();
			 $ingreso -> ingresoController();

		 ?>
		 <div id="alertaJs"></div>
		<input class="form-control formIngreso btn btn-primary" type="submit" value="Enviar">

	</form>

</div>



