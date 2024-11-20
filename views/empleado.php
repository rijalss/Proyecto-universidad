<?php


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['name'])) {
	// Redirigir al usuario a la página de inicio de sesión
	header('Location: .');
	exit();
}
?>

<!DOCTYPE html>
<html lang="ES">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="public/img/favicon.ico" >
	<title>Empleado</title>

	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<div id="mensajes" style="display:none">
	<?php
	if (!empty($mensaje)) {
		echo $mensaje;
	}
	?>
</div>

<body>
	<!-- Header -->
	<?php require_once("public/components/menu.php"); ?>
	<!-- Header -->

	<section class="d-flex flex-column align-items-center my-5">
		<br><br><br><br>
		<h2 class="text-primary text-center">Gestionar Empleado</h2>
			<div class="container">
				<div class="text-left">
					<button class="btn btn-success" id="incluir">Registrar Empleado</button>
				</div>
			</div>
			<div class="container card shadow mb-4 "> <!-- todo el contenido ira dentro de esta etiqueta-->
				<br>
				<div class="container">
				</div>
				<div class="container text-center">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="tablaempleado">
							<thead>
								<tr>
									<th>Perfil</th>
									<th>Prefijo</th>
									<th>Cédula</th>
									<th>Nombre</th>
									<th>Apellido</th>
									<th>Telefono</th>
									<th>Correo</th>
									<th>Cargo</th>


									<th>Acciones</th>
								</tr>
							</thead>
							<tbody id="resultadoconsulta"></tbody>
						</table>
					</div>
				</div>
			</div> <!-- fin de container -->
		</section>

	<!-- Modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="modal1">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Formulario de Empleados</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						</button>
					</div>
						<div class="modal-body">

						<form method="post" id="f" autocomplete="off">
							<input autocomplete="off" type="text" class="form-control" name="accion" id="accion" style="display: none;">
							<div class="container">
								<div class="row mb-3">
									<div class="col-md-2">
										<label for="prefijoCedula">Prefijo</label>
										<select class="form-select" name="prefijoCedula" id="prefijoCedula">
											<option value="V">V</option>
											<option value="E">E</option>
										</select>
										<span id="sprefijoCedula"></span>
									</div>
									<div class="col-md-4">
										<label for="cedulaEmpleado">Cédula</label>
										<input class="form-control" type="text" id="cedulaEmpleado" name="cedulaEmpleado" required />
										<span id="scedulaEmpleado"></span>
									</div>
									<div class="col-md-3">
										<label for="nombreEmpleado">Nombre</label>
										<input class="form-control" type="text" id="nombreEmpleado" name="nombreEmpleado" required />
										<span id="snombreEmpleado"></span>
									</div>
									<div class="col-md-3">
										<label for="apellidoEmpleado">Apellido</label>
										<input class="form-control" type="text" id="apellidoEmpleado" name="apellidoEmpleado" required />
										<span id="sapellidoEmpleado"></span>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-md-4">
										<label for="correoEmpleado">Correo</label>
										<input class="form-control" type="email" id="correoEmpleado" name="correoEmpleado" required />
										<span id="scorreoEmpleado"></span>
									</div>
									<div class="col-md-4">
										<label for="telefonoEmpleado">Teléfono</label>
										<input class="form-control" type="text" id="telefonoEmpleado" name="telefonoEmpleado" required />
										<span id="stelefonoEmpleado"></span>
									</div>
									<div class="col-md-4">
										<label for="cargo">Cargo</label>
										<select class="form-select" name="cargo" id="cargo">
											<option value='disabled' disabled selected>Seleccione un cargo</option>
											<?php
											foreach ($cargos as $cargo) {
												echo "<option value='" . $cargo['clCargo'] . "'>" . $cargo['nombreCargo'] . "</option>";
											}
											?>
										</select>
										<span id="scargo" class="error"></span>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-md-12">
										<center>
											<label for="archivo" style="cursor:pointer">
												<img src="public/img/img-empleado/perfil.jpg" id="imagen" class="img-fluid rounded-circle w-25 mb-3 centered" style="object-fit:scale-down">
												Click aqui para subir foto
											</label>
											<input id="archivo" type="file" style="display:none" accept=".png,.jpg,.jpeg" name="imagenarchivo" />
										</center>
									</div>
									<div class="col">
										<hr />
									</div>
								</div>
							</div>
							<div class="row mt-3 d-flex justify-content-center align-items-center">
								<div class="col-md-2">
									<button type="button" class="btn btn-dark" id="proceso"></button>
								</div>
							</div>
						</form>
					</div>
			</div>
		</div>
	</div>
	
	<!-- Fin del Modal -->

	<!-- Footer -->
	<?php require_once("public/components/footer.php"); ?>
	<?php require_once("public/components/extra.php"); ?>
	<!-- Footer -->
	


	<!-- Scripts -->
	<script  src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="public/js/empleado.js"></script>
	<!-- Scripts -->
</body>

</html>