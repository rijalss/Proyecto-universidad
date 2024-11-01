
<?php

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['name'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header('Location: .');
	
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Empleado</title>
    <!-- Enlace al favicon personalizado -->
	<link rel="icon" href="public/img/favicon.ico" >


	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
	<!--Llamada a archivo modal.php, dentro de el hay una sección modal-->
	<?php require_once("public/components/menu.php"); ?>


	

		<div class="container"> <!-- todo el contenido ira dentro de esta etiqueta-->
		<form method="post" action="" id="f" target="_blank">
				<input type="text" name="accion" id="accion" style="display:none" />
				<h2 class="text-primary text-center">Reportes de Empleado</h2>

			


				<div class="row">
					<div class="col">
						<hr />
					</div>
				</div>

				<div class="row">
		<div class="col">
		   <label for="cedulaEmpleado">Cedula</label>
		   <input class="form-control" type="text" id="cedulaEmpleado" name="cedulaEmpleado" />
		   <span id="scedulaEmpleado"></span>
		</div>
		<div class="col">
		   <label for="nombreEmpleado">Nombre</label>
		   <input class="form-control" type="text" id="nombreEmpleado" name="nombreEmpleado" />
		   <span id="snombreEmpleado"></span>
		</div>
		<div class="col">
		   <label for="apellidoEmpleado">apellido</label>
		   <input class="form-control" type="text" id="apellidoEmpleado" name="apellidoEmpleado" />
		   <span id="sapellidoEmpleado"></span>
		</div>
		<div class="col">
		
				<label for="cargo">Cargo</label>
				<select class="form-control" name="cargo" id="cargo">
				<option value=' ' disabled selected>Seleccione un cargo</option>
				<?php
				foreach ($cargos as $cargo) {
				echo "<option value='" . $cargo['clCargo'] . "'>" . $cargo['nombreCargo'] . "</option>";
				}
				?>
				</select>
				<span id="scargo" class="error"></span>
												
		</div>
	</div>

				

				<div class="row">
					<div class="col">
						<hr />
					</div>
				</div>

			
	<div class="row">
		<div class="col">
			   <button type="submit" class="btn btn-primary" id="generar" name="generar">GENERAR PDF</button>
		</div>
		
	</div>
		

		</form>
		</div> <!-- fin de container -->
	</section>
	
		<!-- seccion del modal productos -->
	</div>

	<!--fin de seccion modal-->

	<?php require_once("public/components/footer.php"); ?>
	<?php require_once("public/components/extra.php");

	?>

	<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>

	
</body>

</html>