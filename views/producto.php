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
					<h6 class="container text-center h2 text-primary">Registro de Productos</h6>
					<br>
					<form method="post">
						<div class="container">
							<div class="row">

								<!-- Inputs encargados de registrar datos para las entradas de productos -->

								<div class="col">
									<label for="codProducto">Codigo del Productos</label>
									<input type="text" class="form-control" id="codProducto" required>
									<span id="scodProducto"></span>
								</div>
								<div class="col">
									<label for="nombreProducto">Nombre del Producto</label>
									<input type="text" class="form-control" id="nombreProducto" required>
									<span id="snombreProducto"></span>
								</div>
								<div class="col">
									<label for="precio">Precio Productos</label>
									<input type="number" class="form-control" id="precio" min="0" required>
									<span id="sprecio"></span>
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
									<label for="descProducto">Descripción del Producto</label>
									<input type="text" class="form-control" id="descProducto" required>
									<span id="sdescProducto"></span>
								</div>
								<div class="col">
									<label for="categoria">Categoría</label>
									<select class="form-control" name="categoria" id="categoria">
										<?php
										$categoria = new Categoria("");
										$categorias = $categoria->obtenerCategorias();
										foreach ($categorias as $categoria) {
											echo "<option value='" . $categoria['nombreCategoria'] . "'>" . $categoria['nombreCategoria'] . "</option>";
										}
										?>
									</select>
								</div>

							</div>

							<div class=" row">
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
	<div class="modal fade" tabindex="-1" aria-labelledby="productomodal" aria-hidden="true" role="dialog" id="modal1">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Listado de Productos</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">

					<!-- Form dentro del modal para agregar cargos a la base de datos -->
					<table class="table table-striped table-hover" id="tablaProductos">
						<thead>
							<tr>
								<th>Código</th>
								<th>Nombre</th>
								<th>Precio</th>
								<th>Descripción</th>
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
	<!-- <script src="public/js/categoria.js"></script> -->
	<script src="public/bootstrap/js/sidebar.js"></script>
	<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="public/js/producto.js"></script>
	<!-- Scripts -->
</body>

</html>