<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Productos</title>
	<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
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

	<section class="d-flex flex-column align-items-center">
		<br><br><br><br>
		<h2 class="text-primary text-center">Gestionar Producto</h2>
		<div class="container">
			<div class="text-left">
				<button class="btn btn-success" id="incluir">Registrar Producto</button>
			</div>
		</div>
		<div class="container card shadow mb-4 "> <!-- todo el contenido ira dentro de esta etiqueta-->
			<br>
			<div class="container">
			</div>
			<div class="container text-center">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="tablaproducto">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nombre</th>
								<th>Último precio</th>
								<th>Descripción</th>
								<!-- <th>Categoría</th> -->
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
					<h5 class="modal-title">Formulario de Productos</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">

					<form method="post" id="f" autocomplete="off">
						<input autocomplete="off" type="text" class="form-control" name="accion" id="accion" style="display: none;">
						<div class="container">
							<div class="row mb-3">
								<div class="container">
									<form id="formularioProducto">
										<div class="row">
											<div class="col-md-6 mb-3">
												<label for="codProducto" class="form-label">Código de producto:</label>
												<input type="text" class="form-control" id="codProducto" name="codProducto" required>
												<span id="scodProducto"></span>
											</div>

											<div class="col-md-6 mb-3">
												<label for="nombreProducto" class="form-label">Nombre:</label>
												<input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
												<span id="snombreProducto"></span>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6 mb-3">
												<label for="precio">Último precio</label>
												<input class="form-control" type="number" id="precio" name="precio" min="0" />
												<span id="sprecio"></span>
												<div class="form-check">
													<label class="form-check-label" for="habilitarPromedio">Habilitar último precio</label>
													<input type="checkbox" class="form-check-input" id="habilitarPromedio" onclick="toggleInput()">
												</div>
											</div>

											<!-- <div class="col-md-6 mb-3">
												<label for="categoria" class="form-label">Categoría:</label>
												<select class="form-control" name="categoria" id="categoria">
													<option value='disabled' disabled selected>Seleccione una categoria</option>
													<?php
													foreach ($categorias as $categoria) {
														echo "<option value='" . $categoria['clCategoria'] . "'>" . $categoria['nombreCategoria'] . "</option>";
													}
													?>
												</select>
												<span id="scategoria" class="error"></span>
											</div>
										</div> -->
								</div>
								<div class="mb-3">
									<label for="descProducto" class="form-label">Descripción:</label>
									<textarea class="form-control" id="descProducto" name="descProducto" rows="3" required></textarea>
									<span id="sdescProducto"></span>
								</div>
					</form>
				</div>
			</div>
			<br>
			<div class="row mt-3 d-flex justify-content-center align-items-center">
				<div class="col-md-2">
					<button type="button" class="btn btn-primary" id="proceso"></button>
				</div>
			</div>
			</form>
		</div>
		<script>
			document.addEventListener('DOMContentLoaded', (event) => {
				const checkbox = document.getElementById('habilitarPromedio');
				const input = document.getElementById('precio');
				input.disabled = true;
				checkbox.checked = false;
			});

			function toggleInput() {
				const checkbox = document.getElementById('habilitarPromedio');
				const input = document.getElementById('precio');
				input.disabled = !checkbox.checked;
			}
		</script>
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

	<script src="public/bootstrap/js/sidebar.js"></script>
	<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="public/js/producto.js"></script>
	<!-- Scripts -->
</body>

</html>