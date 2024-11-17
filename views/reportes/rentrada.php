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
	<title>Reportes Notas de entrada</title>
	<link rel="icon" href="public/img/favicon.ico">
	<link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
	<!--Llamada a archivo modal.php, dentro de el hay una sección modal-->
	<?php require_once("public/components/menu.php"); ?>


	<section class="d-flex flex-column " style="margin-top: 110px;">

		<div class="container"> <!-- todo el contenido ira dentro de esta etiqueta-->
			<form method="post" action="" id="f" target=" _blank">
				<input type="text" name="accion" id="accion" style="display:none" />
				<h2 class="text-primary text-center">Reportes Notas de entrada</h2>

				<div class="row">
					<div class="col-md">
						<hr />
					</div>
				</div>

				<div class="container">
					<div class="row">
						<div class="col-md-2 d-flex align-items-end">
						 <button type="submit" class="btn btn-primary" id="Generar" name="Generar">Crear Reporte PDF</button>
						 </div>

						<div class="col-md-3"> 
							<label for="numfactura">Factura</label> 
							<input class="form-control" type="text" id="numfactura" name="numfactura" />
						 </div>

						<div class="col-md-3"> 
							<label for="proveedor">Proveedor</label>
							 <select class="form-control" name="proveedor" id="proveedor">
								<option value='disabled' disabled selected>Seleccione un Proveedor</option> 
								<?php foreach ($proveedores as $proveedor) {
									echo "<option value='" . $proveedor['clProveedor'] . "'>" . $proveedor['nombreProveedor'] . "</option>";
										} ?>
							</select>
						 </div>

						<div class="col-md-3"> <label for="empleado">Empleado</label>
						 <select class="form-control" name="empleado" id="empleado">
								<option value='disabled' disabled selected>Seleccione un Empleado</option>
								 <?php foreach ($empleados as $empleado) {
								 echo "<option value='" . $empleado['clEmpleado'] . "'>" . $empleado['nombreEmpleado'] . "</option>";
										} ?>
							</select> 
						</div>

					</div>

					<div class="row mt-4">
						<div class="col-md-2 d-flex align-items-end"> 
							<button type="button" class="btn btn-secondary" id="filtrar" name="filtrar">Filtrar Fechas</button> 
						</div>
						<div class="col-md-3">
							<div class="form-floating">
							 <input class="form-control" type="date" id="finicio" name="finicio" />
							  <label for="finicio"><b>Fecha Inicio</b></label> 
							</div>
						</div>

						<div class="col-md-3">
							<div class="form-floating"> <input class="form-control" type="date" id="ffin" name="ffin" />
							 <label for="ffin"><b>Fecha Final</b></label>
							 </div>
						</div>

					</div>
				</div>
			</form>

			<!-- FILA DE DETALLES DE LA VENTA-->
			<div class="container card shadow mb-4 ">
				<div class="container text-center">
					<div class="table-responsive">

						<table class="table table-striped table-hover" id="tablarentrada">
							<thead class="text-center">
								<tr>
									<br>

									<th>Factura</th>
									<th>Nombre Empleado</th>
									<th>Nombre Proveedor</th>
									<th>Nombre de Producto</th>
									<th>Fecha de la entrada</th>
									<th>Cantidad de la Entrada</th>
								</tr>
							</thead>
							<tbody class="text-center" id="entrada">

							</tbody>
						</table>
					</div>
				</div>
			</div>


		</div>

		</div> <!-- fin de container -->
	</section>

	<!-- seccion del modal productos -->
	</div>

	<!--fin de seccion modal-->

	<?php require_once("public/components/footer.php"); ?>
	<?php require_once("public/components/extra.php"); ?>

	<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="public/js/rentrada.js"></script>
</body>

</html>