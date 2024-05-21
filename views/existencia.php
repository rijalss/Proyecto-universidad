<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Existencias</title>
	<link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
					<h6 class="container text-center h2 text-primary">Existencias</h6>
					<br>
					<form method="post">
						<div class="container">
							<div class="card-body">
								<div class="table-responsive">
									<table id="exampl" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th scope="col">Cantidad de existencias</th>
												<th scope="col">Código de producto</th>
												<th scope="col">Nombre del producto</th>
												<th scope="col">Área</th>
												<th scope="col">Categoría</th>
												<th scope="col">Acciones</th>
											</tr>
										</thead>

										<tbody>
											<tr>
												<td>150</td>
												<td>001</td>
												<td>Producto A</td>
												<td>Electrónica</td>
												<td>Gadgets</td>
												<td> <button class="btn btn-warning"><a href=><img class="imgmini" src=" "></a>Modificar</button> <button class="btn btn-danger"><a href=><img class="imgmini" src=" "></a>Eliminar</button> </td>
											</tr>
											<tr>
												<td>75</td>
												<td>002</td>
												<td>Producto B</td>
												<td>Hogar</td>
												<td>Muebles</td>
												<td> <button class="btn btn-warning"><a href=><img class="imgmini" src=" "></a>Modificar</button> <button class="btn btn-danger"><a href=><img class="imgmini" src=" "></a>Eliminar</button> </td>
											</tr>
											<tr>
												<td>200</td>
												<td>003</td>
												<td>Producto C</td>
												<td>Oficina</td>
												<td>Accesorios</td>
												<td> <button class="btn btn-warning"><a href=><img class="imgmini" src=" "></a>Modificar</button> <button class="btn btn-danger"><a href=><img class="imgmini" src=" "></a>Eliminar</button> </td>
											</tr>
										</tbody>
									</table>




								</div>
							</div>

						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div>
		<!-- Footer -->
		<?php require_once("public/commun/footer.php"); ?>
		<!-- Footer -->
	</div> <!-- fin de container -->

	<!-- Scripts -->
	<script src="public/bootstrap/js/sidebar.js"></script>
	<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="public/js/jquery-3.7.0.js"></script>
	<script src="public/js/jquery.dataTables.min.js"></script>
	<script src="public/js/dataTables.bootstrap5.min.js"></script>
	<script src="public/js/datatable.js"></script>
	<!-- Scripts -->
</body>

</html>