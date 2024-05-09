<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/sidebar.css">
</head>
<body>
    <!-- Header -->
        <?php require_once("public/commun/menu.php");?>
    <!-- Header -->
    <br>
    <br>
    <br>
    <br>
	
    <div class="container text-center h2 text-primary">
Pantalla Recepcion de Mercancia
<hr/>
</div>
<div class="container"> <!-- todo el contenido ira dentro de esta etiqueta-->
<!-- Para usar un tab panel, el pimer paso es declarar la sección de control
	esta sera la encargada de mostrar la etiqueta de los tab y de hacer visible 
	a cada una segun se haga click sobre el nombre
-->
<!--Sección de control del tab panel -->

		   <div class="container">
				<div class="row">
					<div class="col">
					   <label for="nfactura">Nº Factura</label>
					   <input class="form-control" type="text" id="nfactura" name="nfactura" />
					   <span id="scedula"></span>
					</div>
					
					<div class="col">
					   <label for="proveedor">Proveedor</label>
					   <input class="form-control" type="text" id="proveedor" name="proveedor" />
					</div>
					
				</div>

				<div class="row">
					<div class="col">
					   <label for="fecha">Fecha</label>
					   <input class="form-control" type="date" id="fecha" name="fecha" />
					</div>
					
					
					<div class="col">
					   <label for="monto">Monto</label>
					   <input class="form-control" type="text" id="monto" name="monto" />
					</div>
					
				</div>
				
				
				
		</div>
	</div>

</div> <!-- fin de container -->
<div class="container">
	<div class="row">
			<div class="col">
				<hr/>
			</div>
	</div>

	<div class="row">
		<div class="col">
			   <button type="button" class="btn btn-primary" id="incluir" name="incluir">INCLUIR</button>
		</div>
		<div class="col">	
			   <button type="button" class="btn btn-primary" id="consultar" 
			   data-toggle="modal" data-target="#modal1" name="consultar">CONSULTAR</button>
		</div>
		<div class="col">	
			   <button type="button" class="btn btn-primary" id="modificar" name="modificar">MODIFICAR</button>
		</div>
		<div class="col">	
			   <button type="button" class="btn btn-primary" id="eliminar" name="eliminar">ELIMINAR</button>
		</div>
		<div class="col">	
			   <a href="." class="btn btn-primary">REGRESAR</a>
		</div>
	</div>
</div>
    
    <!-- Footer -->
        <?php require_once("public/commun/footer.php") ?> 
    <!-- Footer -->

    <!-- Scripts -->
<script src="public/bootstrap/js/sidebar.js"></script>
<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts -->
</body>
</html>