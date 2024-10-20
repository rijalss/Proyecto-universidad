<html> 
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
<form method="post" action="" id="f">
<input type="text" name="accion" id="accion" style="display:none"/>
        <h2 class="text-primary text-center">Gestionar Notas de Entrada</h2>

        <div class="container">
            <div class="text-left">
                <button type="button" class="btn btn-success" id="registrar" name="registrar">Registrar Notas de Entrada</button>
            </div>
        </div>


	<div class="row">
		<div class="col">
			<hr/>
		</div>
	</div>
	<div class="container">
        <div class="row">
		    <div class="col-md-3 ">
			    <label for="numfactura">Factura</label>
		        <input class="form-control" type="text" id="numfactura" name="numfactura" />
                <span id="snumfactura"></span>
		    </div>
            <div class="col-md-3">
                 <label for="proveedor">Proveedor</label>
                    <select class="form-control" name="proveedor" id="proveedor">
                        <option value='disabled' disabled selected>Seleccione un Proveedor</option>        
                            <?php
						    foreach ($proveedores  as $proveedor) {
						    echo "<option value='" . $proveedor['clProveedor'] . "'>" . $proveedor['nombreProveedor'] . "</option>";
											}?>
                     </select>
            </div>
            <div class="col-md-3">
                <label for="empleado">Empleado</label>
                <select class="form-control" name="empleado" id="empleado">
                <option value='disabled' disabled selected>Seleccione un Empleado</option>
                <?php
				foreach ($empleados as $empleado) {
				echo "<option value='" . $empleado['clEmpleado'] . "'>" . $empleado['nombreEmpleado'] . "</option>";
									}?>
                              </select>
            </div>
    
	    </div>
    </div>
	<!-- FIN DE FILA INPUT Y BUSCAR CLIENTE -->

	<!-- FIN DE FILA DATOS DEL CLIENTE -->
		
	<div class="row">
		<div class="col">
			<hr/>
		</div>
	</div>

    <!-- FILA DE BUSQUEDA DE PRODUCTOS -->
	<div class="row">
		<div class="col-md-8 input-group">
		   <input class="form-control" type="text" id="codigoproducto" name="codigoproducto" />
		   <input class="form-control" type="text" id="idproducto" name="idproducto" style="display:none"/>
		   <button type="button" class="btn btn-primary" id="listadodeproductos" name="listadodeproductos">LISTADO DE PRODUCTOS</button>
		</div>
	</div>
	<!-- FIN DE FILA BUSQUEDA DE PRODUCTOS -->
	<div class="row">
		<div class="col">
			<hr/>
		</div>
	</div>
	<!-- FILA DE DETALLES DE LA VENTA -->

<div class="table-responsive card shadow">
	
	<div class="row">
		<div class="col-md-12">
		   <table class="table table-striped table-hover">
				<thead>
				  <tr>
				    <th>X</th>
					<th style="display:none">Cl</th>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Cantidad</th>
					<th>Precio</th>
				  </tr>
				</thead>
				<tbody id="detalledeventa">

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
<div class="modal fade" tabindex="-1" role="dialog" id="modalproductos">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Listado de productos</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-striped table-hover">
						<thead>
		 					 <tr>
		    					<th style="display:none">Id</th>
								<th>Codigo</th>
								<th>Nombre</th>
			
		 							 </tr>
						</thead>
						<tbody id="listadoproductos">
		 
						</tbody>
					</table>		
				</div>
			</div>
		</div>
<!-- seccion del modal productos -->
</div>

<!--fin de seccion modal-->

<?php require_once("public/components/footer.php"); ?>
<?php require_once("public/components/extra.php");

?>

<script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
  
<script type="text/javascript" src="public/js/entrada.js"></script>
</body>
</html>