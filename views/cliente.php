<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
    <!-- Header -->
    
    <?php require_once("public/commun/menu.php"); ?>
    <?php require_once("public/commun/extras.php"); ?>
    <!-- modal para las alertas -->
      <?php require_once("public/commun/modal.php"); ?>
    <!-- Header -->
    <br>
    <br>
    <br>
    <br>
  
    <div class="container-center m-5">
        <div class="container-fluid">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="container text-center h2 text-primary">Clientes</h6>
                    <br>
                    <form method="post">
                        <div class="container">
                            <div class="row">

                                <!-- Inputs encargados de registrar datos para las entradas de productos -->

                                <div class="col">
                                    <label for="cedulaCliente">Cédula del Cliente</label>
                                    <input type="text" class="form-control" id="cedulaCliente" name="cedulaCliente" required>
                                    <span id="scedulaCliente"></span>
                                </div>
                                <div class="col">
                                    <label for="telefonoCliente">Teléfono del Cliente</label>
                                    <input type="text" class="form-control" id="telefonoCliente" name="telefonoCliente" required>
                                    <span id="stelefonoCliente"></span>
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
                                    <label for="nombreCliente">Nombre del Cliente</label>
                                    <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" required>
                                    <span id="snombreCliente"></span>
                                </div>
                                <div class="col">
                                    <label for="apellidoCliente">Apellido del Cliente</label>
                                    <input type="text" class="form-control" id="apellidoCliente" name="apellidoCliente" required>
                                    <span id="sapellidoCliente"></span>
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
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-primary" id="incluir" >INCLUIR</button>
                                    </div>
                                    <div class="col-md-2">	
                                        <button type="button" class="btn btn-primary" id="consultar" >CONSULTAR</button>
                                    </div>
                                    <div class="col-md-2">	
                                        <button type="button" class="btn btn-primary" id="modificar" >MODIFICAR</button>
                                    </div>
                                    <div class="col-md-2">	
                                        <button type="button" class="btn btn-primary" id="eliminar" >ELIMINAR</button>
                                    </div>
                                    <div class="col-md-2">	
                                        <a href="." class="btn btn-primary">REGRESAR</a>
                                    </div>
                            </div>


  
                            <!-- inicio del modal -->
                            <div class="container">	  
                            <div class="modal fade" tabindex="-1" role="dialog"  id="modal1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header text-light bg-primary">
                                        <h5 class="modal-title">Listado de Personas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <table class="table table-striped table-hover" id="tablacliente">
                                        <thead>
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Apellidos</th>
                                            <th>Nombres</th>
                                            <th>telefono</th>
                                        </tr>
                                        </thead>
                                        <tbody id="resultadoconsulta">
                                        
                                        
                                        </tbody>
                                        </table> 
                                </div>
                                <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                    Cerrar
                                </button>
                                </div>
                                </div>
                            </div>
                            </div>
                          </div>
                             <!--fin de seccion modal-->
                                                      
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <?php require_once("public/commun/footer.php"); ?>
    <!-- Footer -->

                                                         
    <!-- Scripts -->
    <script src="public/bootstrap/js/sidebar.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="public/js/cliente.js"></script>
    <!-- Scripts -->
</body>

</html>