<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Proveedor</title>
	<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
	<!-- Header -->
	<?php require_once("public/commun/menu.php"); ?>
	<?php require_once("public/commun/extras.php"); ?>
	<!-- Header -->
	<br>
	<br>
	<br>
	<br>

	<div class="container-center m-5">
		<div class="container-fluid">

			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="container text-center h2 text-primary">Registro de Proveedor</h6>
					<br>
					<form method="post">
						<div class="container">
							<div class="row">

								<!-- Inputs encargados de registrar datos para las entradas de productos -->

								<div class="col">
									<label for="rifProveedor">Rif del Proveedor</label>
									<input type="text" class="form-control" id="rifProveedor" required>
									<span id="srifProveedor"></span>
								</div>
								<div class="col">
									<label for="nombreProveedor">Nombre del Proveedor</label>
									<input type="text" class="form-control" id="nombreProveedor" required>
									<span id="snombreProveedor"></span>
								</div>
								<div class="col">
									<label for="correoProveedor">Correo del Proveedor</label>
									<input type="email" class="form-control" id="correoProveedor" required>
									<span id="scorreoProveedor"></span>
								</div>


							</div>


							<div class="row">
								<div class="col">
									<br>
									<hr />
								</div>
							</div>

							<div class="row">

								<div class="col">
									<label for="telefonoProveedor">Telefono del Proveedor</label>
									<input type="text" class="form-control" id="telefonoProveedor" required>
									<span id="stelefonoProveedor"></span>
								</div>
								<div class="col">
									<label for="direccionProveedor">Direccion del Proveedor</label>
									<input type="text" class="form-control" id="direccionProveedor" required>
									<span id="sdireccionProveedor"></span>
								</div>

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
									<button type="button" class="btn btn-success" id="consultar" name="consultar">CONSULTAR</button>
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
	<div class="modal fade" tabindex="-1" aria-labelledby="cargomodal" aria-hidden="true" role="dialog" id="modal1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Listado de Proveedores</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<!-- Form dentro del modal para agregar cargos a la base de datos -->
					<table class="table table-striped table-hover" id="tablaproveedor">
						<thead>
							<tr>
								<th>Rif</th>
								<th>Nombre</th>
								<th>Teléfono</th>
								<th>Correo</th>
								<th>Dirección</th>
							</tr>
						</thead>
						<tbody id="resultadoconsulta">

						</tbody>
					</table>

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
	<script type="text/javascript" src="public/js/proveedor.js"></script>
	<!-- Scripts -->
</body>

</html>