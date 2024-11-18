<?php


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['name'])) {
	// Redirigir al usuario a la página de inicio de sesión
	header('Location: .');
	exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Notas de salida</title>
	<link rel="icon" href="public/img/favicon.ico"> 
	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>

	<?php require_once("public/components/menu.php"); ?>


	<section class="d-flex flex-column " style="margin-top: 110px;">

		<div class="container">
			<form method="post" action="" id="form">
				<input type="text" name="accion" id="accion" style="display:none" />
				<h2 class="text-primary text-md-center">Gestionar Notas de Salida</h2>

				<div class="container">
					<div class="text-md-left mb-3">
						<button type="button" class="btn btn-success" style="margin-right: 10px;" id="registrar" name="registrar">Registrar Notas de Salida</button>
					</div>
				</div>

				<div class="row">
					<div class="col-md">
						<hr />
					</div>
				</div>
				<div class="container ">
					<div class="row md-3">

						<div class="col-md-3">
							<label for="ubi">Ubicación</label> <select name="ubi" id="ubi" class="form-select">
								<option value="1">Almacen</option>
								<option value="2">Mostrador</option>
							</select>
						</div>

						<div class="col-md-3">
							<label for="empleado">Empleado</label>
							<select class="form-select" name="empleado" id="empleado">
								<option value='disabled' disabled selected>Seleccione un Empleado</option>
								<?php
								foreach ($empleados as $empleado) {
									echo "<option value='" . $empleado['clEmpleado'] . "'>" . $empleado['nombreEmpleado'] . "</option>";
								} ?>
							</select>
						</div>


						<div class="col-md-6 p-4">
							<div class="col-md-2 input-group">
								<input class="form-control" type="text" id="codigoproducto" name="codigoproducto" />
								<input class="form-control" type="text" id="idproducto" name="idproducto" style="display:none" />
								<button type="button" class="btn btn-primary" id="listadodeproductos" name="listadodeproductos">LISTADO DE PRODUCTOS</button>
							</div>
						</div>
					</div>


					<div class="table-responsive card shadow ms-0"> <!-- container card shadow mb-4 -->
						<div class="row">
							<div class="col-md-12">
								<table class="table table-striped table-hover" id="tabSalida">
									<thead class="text-md-center">
										<tr>
											<th>X</th>
											<th style="display:none">Id</th>
											<th>Codigo</th>
											<th>Nombre</th>
											<th>Cantidad disponible</th>
											<th>Cantidad salida</th>
											<th>Precio salida</th>
										</tr>
									</thead>
									<tbody class="text-md-center" id="salidadetalle">

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>

	<div class="modal fade" tabindex="-1" role="dialog" id="modalproductos">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title ">Listado de Productos</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<div class="container">
						<div class="row mb-3">
							<div class="container ">
								<table class="table table-striped table-hover align-middle" id="tsalida">
									<thead class="text-md-center">
										<tr>
											<th style="display:none">Id</th>
											<th>Codigo</th>
											<th>Nombre</th>
											<th>Cantidad disponible</th>
										</tr>
									</thead>
									<tbody class="text-md-center" id="listadoproductos">

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once("public/components/footer.php"); ?>
	<?php require_once("public/components/extra.php"); ?>

	<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="public/js/salida.js"></script>

</body>

</html>