
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
	<title>Notas de entrada</title>

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
				<h2 class="text-primary text-center">Reportes de Notas de entrada</h2>

				<div class="container">
					<div class="text-left">
						<button type="submit"  class="btn btn-danger" id="Generar" name="Generar">Generar PDF</button>
					</div>
				</div>


				<div class="row">
					<div class="col">
						<hr />
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-md-3 ">
							<label for="finicio">fecha de inicio</label>
							<input class="form-control" type="date" id="finicio" name="finicio" <?php echo date("Y-m-d");?>/>
							<span id="sfinicio"></span>
						</div>
						<div class="col-md-3 ">
							<label for="ffin">fecha de final</label>
							<input class="form-control" type="date" id="ffin" name="ffin" value=<?php echo date("Y-m-d");?>/>
							<span id="sffin"></span>
						</div>
					</div>
				</div>
				<!-- FIN DE FILA INPUT Y BUSCAR CLIENTE -->

				<!-- FIN DE FILA DATOS DEL CLIENTE -->

				<div class="row">
					<div class="col">
						<hr />
					</div>
				</div>

				<!-- FILA DE BUSQUEDA DE PRODUCTOS -->
			
				
				<!-- FILA DE DETALLES DE LA VENTA -->

				<div class="table-responsive card shadow">

					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped table-hover" id="tablaentrada">
								<thead class="text-center">
									<tr>
										<th>X</th>
										<th style="display:none">Cl</th>
										<th>Codigo</th>
										<th>Nombre</th>
										<th>Cantidad</th>
										<th>Precio</th>
									</tr>
								</thead>
								<tbody class="text-center" id="entrada">

								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- FIN DE FILA DETALLES DE LA VENTA -->
		</div>
		</form>
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