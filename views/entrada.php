<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas de entrada</title>

   <Header>
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>




<body>
    <!-- Header -->
    <?php require_once("public/components/menu.php"); ?>
    <!-- Header -->
    
    <section class="d-flex flex-column align-items-center" style="margin-top: 110px;">
        
        <h2 class="text-primary text-center">Gestionar Notas de Entrada</h2>
        <div class="container">
            <div class="text-left">
                <button class="btn btn-success" id="incluir">Registrar Notas de Entrada</button>
            </div>
        </div>
        <div class="container card shadow mb-4 "> <!-- todo el contenido ira dentro de esta etiqueta-->
            <br>
            <div class="container">
            </div>
            <div class="container text-center">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="tablaentrada">
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <th>Factura</th>
                                <th>Fecha</th>
                                <th>Empleado</th>
                                <th>Acciones</th>
                                <!--<th>cantidad producto</th>
                                <th>precio</th>-->
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulario de Notas de Entrada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" autocomplete="off" id="myForm">
                        <input autocomplete="off" type="text" class="form-control" name="accion" id="accion" style="display: none;">
                        <div class="container">
                            <div class="row mb-3">

                                <div class="col-3">
                                    <label for="proveedor">Proveedor</label>
                                    <select class="form-control" name="proveedor" id="proveedor">
                                        <option value='disabled' disabled selected>Selecione un Proveedor</option>
                                        
                                        <?php
											foreach ($proveedores  as $proveedor) {
											echo "<option value='" . $proveedor['clProveedor'] . "'>" . $proveedor['nombreProveedor'] . "</option>";
											}
											?>
                                    </select>
                                    <span id="sproveedor" class="error"></span> 
                                </div>
                                <div class="col-3">
                                    <label for="numFactura">N°Factura</label>
                                    <input class="form-control" type="text" id="numFactura" name="numFactura">
                                    <span id="snumFactura"></span>
                                </div>
                               
                                <div class="col-3">

                              
                                    <label for="fechaEntrada">Fecha</label>
                                    <input class="form-control" type="datetime-local" id="fechaEntrada" name="fechaEntrada" >

                                    <span id="sfechaEntrada"></span>
                                </div>

                                <div class="col-3">
                                <label for="empleado">Empleado</label>
                                <select class="form-control" name="empleado" id="empleado">
                                <option value='disabled' disabled selected>Seleccione un Empleado</option>
                                <?php
											foreach ($empleados as $empleado) {
											echo "<option value='" . $empleado['clEmpleado'] . "'>" . $empleado['nombreEmpleado'] . "</option>";
											}
											?>
                                </select>
                                <span id="sempleado"></span>
                             </div>
                            </div>
                               
                         <div class="row mb-3">
                           
                        
                                <div class="col-3">
                         
                                <label for="producto">Productos</label>  
                         
                                <select class="form-control" name="producto[]" id="producto">
                                <option value='disabled' disabled selected>Seleccione un Producto</option>
                                <?php
                                    foreach ($productoss as $productos) {
                                        echo "<option value='". $productos['clProducto'] . "'>" . $productos['nombreProducto'] . "</option>";
                                        }
                                            ?>
                                </select>
                                <span id="sproducto"></span>
                            </div>

                            <div class="col-1 px-1 d-flex align-items-end  ">
                            <input type="text" class="form-control" name="cantidad[]" id="cantidadProducto" placeholder="Cantidad">
                            </div>

                         <div class="col-1 px-1 d-flex align-items-end ">
                        <input type="text" class="form-control" name="precio[]" id="precioProducto" placeholder="Precio">
                        </div>

                        <div class="col-1 d-flex align-items-end ">
                        <button type="button" class="btn btn-primary" id="btnProducto"><img width="20PX" src="public/icons/svg/plus-circle.svg" alt=""> </button>
                        </div>
                        
                           
                         </div>
                        
                        <div id="new-inputs-container" class=" row mb-3 "></div>
                            
                         

                        <div class="row">
                            <div class="col-12">

                                <hr />
                            </div>
                        </div>
                        
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
  
    <script type="text/javascript" src="public/js/entrada.js"></script>
    <!-- Scripts -->
    <script>
    var productos = <?php echo $productos_json ?>;
    </script>

</body>

</html>