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
					<h6 class="container text-center h2 text-primary">Productos</h6>
					<br>
					<form method="post">
						<div class="container">
							<div class="row">

								<!-- inputs para agregar informacion sobre el producto -->

								<div class="col">
									<label for="codProducto">Codigo del producto</label>
									<input class="form-control" type="text" id="codProducto" name="codProducto" />
									<span id="scodProducto"></span>
								</div>
								<div class="col">
									<label for="nombreProducto">Nombre del producto</label>
									<input class="form-control" type="text" id="nombreProducto" name="nombreProducto" />
									<span id="snombreProducto"></span>
								</div>
								<div class="col">
									<label for="categorias">Categorias</label>
									<select class="form-control" name="categorias" id="categorias">
										<option value="" disabled selected>Seleccione una categoria</option>
										<option value="1">Papeleria</option>
										<option value="2">Jugueteria</option>
										<option value="3">Electronica</option>

									</select>
								</div>
								<div class="col-2">
									<label for="agregarcategoria">&nbsp;</label>
									<button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#agregarcategoria">
										Agregar Categoría
									</button>

									<!-- Modal encargado de agregar un nueva categoria -->

									<div class="modal fade" id="agregarcategoria" tabindex="-1" aria-labelledby="categoriamodal" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="categoriamodal">Agregar Categoría</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">

													<!-- Form dentro del modal para agregar cartegorias a la base de datos -->

													<form method="post">
														<div class="mb-3">
															<label for="nombreCategoria" class="form-label">Nombre de la Categoría</label>
															<input type="text" class="form-control" id="nombreCategoria" name="category_name" required>
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

							<div class="row">
								<div class="col">
									<br>
									<hr />
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="col-12">
										<label for="promedioPrecio">Precio promedio del producto</label>
										<input class="form-control" type="number" id="promedioPrecio" name="promedioPrecio" />
										<span id="spromedioPrecio"></span>
									</div>
									<br>

									<!-- Checkbox para habilitar o deshabilitar el input -->

									<div class="form-check">
										<label class="form-check-label" for="habilitarPromedio">Habilitar precio promedio</label>
										<input type="checkbox" class="form-check-input" id="habilitarPromedio" onclick="toggleInput()">
									</div>
								</div>

								<!-- Script para poder apagar el input de precio promedio -->

								<script>
									document.addEventListener('DOMContentLoaded', (event) => {
										const checkbox = document.getElementById('habilitarPromedio');
										const input = document.getElementById('promedioPrecio');
										input.disabled = true;
										checkbox.checked = false;
									});

									function toggleInput() {
										const checkbox = document.getElementById('habilitarPromedio');
										const input = document.getElementById('promedioPrecio');
										input.disabled = !checkbox.checked;
									}
								</script>

								<!-- Campo para describir o detallar el producto -->

								<div class="col-7">
									<label for="detalleProducto">Descripcion del producto</label>
									<textarea class="form-control" id="detalleProducto" name="detalleProducto" rows="5"></textarea>
									<span id="sdetalleProducto"></span>
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
	<script type="text/javascript" src="public/js/producto.js"></script>
	<!-- Scripts -->
</body>

</html>