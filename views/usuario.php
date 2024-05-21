<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Empleados</title>
	<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
	<!-- Header -->
	<?php require_once("public/commun/menu.php"); ?>
	<!-- Header -->
	<br>
	<br>
	<br>
	<br>

	<div class="container-center m-5">
		<div class="container-fluid">

			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="container text-center h2 text-primary">Registro de Empleados</h6>
					<br>
					<form method="post">
						<div class="container">
							<div class="row">

								<!-- Inputs encargados de registrar datos para los vendedores -->

								<div class="col">
									<label for="cedulaTrabajador">Cedula del vendedor</label>
									<input class="form-control" type="text" id="cedulaTrabajador" name="cedulaTrabajador" />
								</div>

								<div class="col">
									<label for="nombreTrabajador">Nombre</label>
									<input class="form-control" type="text" id="nombreTrabajador" name="nombreTrabajador" />
								</div>
								<div class="col">
									<label for="apellidoTrabajador">Apellido</label>
									<input class="form-control" type="text" id="apellidoTrabajador" name="apellidoTrabajador" />
								</div>

							</div>

							<br>
							<div class="row">

								<div class="col">
									<label for="correoTrabajador">Correo</label>
									<input class="form-control" type="email" id="correoTrabajador" name="correoTrabajador" />
								</div>
								<div class="col">
									<label for="telefonoTrabajador">Número de teléfono</label>
									<input class="form-control" type="text" id="telefonoTrabajador" name="telefonoTrabajador" />
								</div>

								<div class="row">
									<div class="col">
										<br>
										<hr />
									</div>
								</div>

								<!-- Select y modal encargado de seleccionar, al igual que agregar cargos -->

								<div class="row justify-content-center">

									<div class="col-4">
										<label for="cargo">Cargo</label>
										<select class="form-control" name="cargo" id="cargo">
											<option value="" disabled selected>Seleccione un area</option>
											<option value="1">administrador</option>
											<option value="2">almacenista</option>
											<option value="3">vendedor</option>

										</select>
									</div>

									<div class="col-2">

										<label for="agregarcargo">&nbsp;</label>
										<button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#agregarcargo">
											Agregar Cargo
										</button>

										<!-- Modal encargado de agregar un nuevo cargo -->

										<div class="modal fade" id="agregarcargo" tabindex="-1" aria-labelledby="cargomodal" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="cargomodal">Agregar Cargos</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">

														<!-- Form dentro del modal para agregar cargos a la base de datos -->

														<form method="post">
															<div class="mb-3">
																<label for="nombreCargo" class="form-label">Nombre del cargo</label>
																<input type="text" class="form-control" id="nombreCargo" name="nombreCategoria" required>
															</div>
															<div class="text-center">
																<button type="submit" class="btn btn-primary">Agregar</button>
															</div>

														</form>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>

								<!-- Campo para agregar observaciones (row es para marcar el tamaño del campo de texto) -->

							</div>

							<div class="row">
								<div class="col">
									<br>
									<hr />
								</div>
							</div>

							<!-- Botonera para cumplir acciones -->

							<div class="row container text-center">
								<div class="col  mb-4">
									<button type="button" class="btn btn-primary " id="incluir" name="incluir">INCLUIR</button>
								</div>
								<div class="col mb-4">
									<button type="button" class="btn btn-success" id="consultar" data-toggle="modal" data-target="#modal1" name="consultar">CONSULTAR</button>
								</div>
								<div class="col mb-4">
									<button type="button" class="btn btn-warning" id="modificar" name="modificar">MODIFICAR</button>
								</div>
								<div class="col mb-4">
									<button type="button" class="btn btn-danger" id="eliminar" name="eliminar">ELIMINAR</button>
								</div>
								<div class="col mb-4">
									<a href="?pagina=principal" class="btn btn-secondary">REGRESAR</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- Footer -->
	<?php require_once("public/commun/footer.php"); ?>
	<!-- Footer -->
	</div> <!-- fin de container -->

	<!-- Scripts -->
	<script src="public/bootstrap/js/sidebar.js"></script>
	<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Scripts -->
</body>

</html>