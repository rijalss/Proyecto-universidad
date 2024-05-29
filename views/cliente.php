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



                            <!-- inicio del modal -->
                            <div class="modal fade" tabindex="-1" aria-labelledby="cargomodal" aria-hidden="true" role="dialog" id="modal1">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Listado de Clientes</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <!-- Form dentro del modal para agregar cargos a la base de datos -->
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