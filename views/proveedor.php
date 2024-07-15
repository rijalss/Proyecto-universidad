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
	<?php require_once("public/components/menu.php"); ?>
	<!-- Header -->

	<section class="d-flex flex-column align-items-center" style="margin-top: 110px;">
		
		<h2 class="text-primary text-center">Gestionar Proveedor</h2>
		<div class="container">
			<div class="text-left">
				<button class="btn btn-success" id="incluir">Registrar Proveedor</button>
			</div>
		</div>
		<div class="container card shadow mb-4 "> <!-- todo el contenido ira dentro de esta etiqueta-->
			<br>
			<div class="container">
			</div>
			<div class="container text-center">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="tablaproveedor">
						<thead>
							<tr>
								<th>RIF</th>
								<th>Nombre</th>
								<th>Teléfono</th>
								<th>Correo</th>
								<th>Dirección</th>
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
					<h5 class="modal-title">Formulario de Proveedores</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">

					<form method="post" id="f" autocomplete="off">
						<input autocomplete="off" type="text" class="form-control" name="accion" id="accion" style="display: none;">
						<div class="container">
							<div class="row mb-3">

								<div class="col-1">
									<label for="prefijoRif"></label>
									<select class="form-control" name="prefijoRif" id="prefijoRif">
										<option value="J">J</option>
										<option value="V">V</option>
										<option value="G">G</option>
									</select>
									<span id="sprefijoRif"></span>
								</div>
								<div class="col-3">
									<label for="rifProveedor">Rif</label>
									<input class="form-control" type="text" id="rifProveedor" name="rifProveedor">
									<span id="srifProveedor"></span>
								</div>
								<div class="col-5">
									<label for="nombreProveedor">Nombre</label>
									<input class="form-control" type="text" id="nombreProveedor" name="nombreProveedor">
									<span id="snombreProveedor"></span>
								</div>
								<div class="col-3">
									<label for="telefonoProveedor">Teléfono</label>
									<input class="form-control" type="text" id="telefonoProveedor" name="telefonoProveedor">
									<span id="stelefonoProveedor"></span>
								</div>

							</div>
							<div class="row mb-3">
								<div class="col-6">
									<label for="correoProveedor">Correo</label>
									<input class="form-control" type="text" id="correoProveedor" name="correoProveedor">
									<span id="scorreoProveedor"></span>
								</div>
								<div class="col-6">
									<label for="direccionProveedor">Dirección</label>
									<input class="form-control" type="text" id="direccionProveedor" name="direccionProveedor">
									<span id="sdireccionProveedor"></span>
								</div>
							</div>
						</div>
						<br>
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
	</div> <!-- fin de container -->

	<!-- Scripts -->


	<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="public/js/proveedor.js"></script>
	<!-- Scripts -->
</body>

</html>