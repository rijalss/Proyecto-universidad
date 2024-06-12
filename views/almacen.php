<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacenes</title>
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
                    <h6 class="container text-center h2 text-primary">Gestionar Almaneces</h6>
                    <br>
                    <form method="post">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <label for="nombreAlmacen">Nombre del Almacen</label>
                                    <input type="text" class="form-control" id="nombreAlmacen" required>
                                    <span id="snombreAlmacen"></span>
                                </div>
                                <!-- Inputs encargados de registrar datos para el registro de Areas -->
                                <div class="col-3">
                                    <label for="agregarArea">&nbsp;</label>
                                    <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#agregarArea">
                                        Agregar Area
                                    </button>

                                    <!-- Modal encargado de agregar un nueva Area -->

                                    <div class="modal fade" id="agregarArea" tabindex="-1" aria-labelledby="Areamodal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="Areamodal">Agregar Area</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <!-- Form dentro del modal para agregar Area a la base de datos -->

                                                    <form method="post">
                                                        <div class="mb-3">
                                                            <label for="nombreArea" class="form-label">Nombre del Area</label>
                                                            <input type="text" class="form-control" id="nombreArea" name="nombreArea" required>
                                                            <span id="snombreArea"></span>
                                                        </div>
                                                        <span id="snombreArea"></span>
                                                        <label for="codAlmacen">Ubicación del Area</label>
                                                        <select class="form-control" name="codAlmacen" id="codAlmacen">
                                                            <option value="" disabled selected>Seleccione un almacen</option>
                                                            <option value="1">Almacen 1</option>
                                                            <option value="2">Almacen 2</option>
                                                            <option value="3">Almacen 3</option>
                                                        </select>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="direccionAlmacen">Direccion del almacen</label>
                                    <textarea class="form-control" id="direccionAlmacen" name="direccionAlmacen" rows="2"></textarea>
                                    <span id="sdireccionAlmacen"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <br>
                                    <hr />
                                </div>
                            </div>
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
                    </form>
                </div>
                <!-- Botonera para cumplir acciones -->


            </div>

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
    <script type="text/javascript" src="public/js/almacen.js"></script>
    <!-- Scripts -->
</body>

</html>