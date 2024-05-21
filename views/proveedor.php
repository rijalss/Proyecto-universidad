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
								</div>
								<div class="col">
									<label for="nombreProveedor">Nombre del Proveedor</label>
									<input type="text" class="form-control" id="nombreProveedor" required>
								</div>
								<div class="col">
									<label for="correoProveedor">Correo del Proveedor</label>
									<input type="text" class="form-control" id="correoProveedor" required>
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
									<label for="telefonoCorreo">Telefono del Proveedor</label>
									<input type="text" class="form-control" id="telefonoCorreo" required>
								</div>
								<div class="col">
									<label for="correoProveedor">Correo del Proveedor</label>
									<input type="text" class="form-control" id="correoProveedor" required>
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
									<button type="button" class="btn btn-success" id="consultar" data-toggle="modal" data-target="#modal1" name="consultar">CONSULTAR</button>
								</div>
								<div class="col mb-4">
									<button type="button" class="btn btn-warning" id="modificar" name="modificar">MODIFICAR</button>
								</div>
								<div class="col mb-4">
									<button type="button" class="btn btn-danger" id="eliminar" name="eliminar">ELIMINAR</button>
								</div>
								<div class="col mb-4">
									<a href="." class="btn btn-secondary">REGRESAR</a>
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