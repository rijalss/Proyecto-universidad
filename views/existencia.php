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
	<title>Existencia</title>
	<link rel="icon" href="public/img/favicon.ico">

	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
	<!-- Header -->
	<?php require_once("public/components/menu.php"); ?>
	<!-- Header -->

	<section class="d-flex flex-column align-items-center" style="margin-top: 110px;">

		<h2 class="text-primary text-center">Listar Existencias</h2>

		<div class="container card shadow mb-4 "> <!-- todo el contenido ira dentro de esta etiqueta-->
			<br>
			<div class="container  dropdown-menu">
			</div>
			<div class="container text-center">
				<div class="table-responsive">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button"
								role="tab" aria-controls="tab1" aria-selected="true">Almacen</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button"
								role="tab" aria-controls="tab2" aria-selected="false">Mostrador</button>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1-tab">
							<table class="table table-striped table-hover" id="tablaalmacen">
								<thead>
									<tr>
										<th>Producto</th>
										<th>Cantidad en Almacén</th>
										<th>Categoria</th>
										<th>Ultima Entrada</th>
										<th>Proveedor</th>
									</tr>
								</thead>
								<tbody id="resultadoconsulta"></tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2-tab">
							<table class="table table-striped table-hover" id="tablamostrador">
								<thead>
									<tr>
										<th>Producto</th>
										<th>Cantidad en Mostrador</th>
										<th>Categoria</th>
										<th>Ultima Salida</th>
										<th>Empleado</th>
									</tr>
								</thead>
								<tbody id="resultadoconsulta_mostrador"></tbody>
							</table>
						</div>
					</div>


				</div>
			</div>
		</div> <!-- fin de container -->
	</section>

	<!-- Footer -->
	<?php require_once("public/components/footer.php"); ?>
	<?php require_once("public/components/extra.php"); ?>
	<!-- Footer -->
	</div> <!-- fin de container -->

	<!-- Scripts -->


	<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="public/js/existencia.js"></script>
	<!-- Scripts -->
</body>

</html>