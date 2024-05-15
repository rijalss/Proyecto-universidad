<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrada</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
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
                    <h6 class="container text-center h2 text-primary">Entregas</h6>
                    <br>
                    <form method="post" action="" id="">
                        <div class="container">
                            <div class="row">
                                <!-- Inputs encargados de registrar datos para las entradas de productos -->
                                <div class="col">
                                    <label for="numFacturaProveedor">Factura del proveedor</label>
                                    <input class="form-control" type="text" id="numFacturaProveedor" name="numFacturaProveedor" />
                                </div>
                                <div class="col">
                                    <label for="fechaEntrega">Fecha de entrega</label>
                                    <input class="form-control" type="datetime-local" id="fechaEntrega" name="fechaEntrega" />
                                </div>
                                <div class="col">
                                    <label for="cantidadEntrega">Cantidad del producto entregado</label>
                                    <input class="form-control" type="number" id="cantidadEntrega" name="cantidadEntrega" />
                                </div>
                                <div class="col">
                                    <label for="precioEntrega">Precio</label>
                                    <input class="form-control" type="number" id="precioEntrega" name="precioEntrega" />
                                </div>


                            </div>

                            <div class="row">
                                <div class="col">
                                    <br>
                                    <hr />
                                </div>
                            </div>

                            <div class="row">
                                <!-- Selects para los demas registros, para que futuramente funcione junto a la base de datos -->
                                <div class="col">
                                    <label for="areas">Areas</label>
                                    <select class="form-control" name="areas" id="areas">
                                        <option value="" disabled selected>Seleccione un area</option>
                                        <option value="1">Papeleria</option>
                                        <option value="2">Jugueteria</option>
                                        <option value="3">Electronica</option>

                                    </select>
                                    <br>
                                    <label for="almacen">Almacenes</label>
                                    <select class="form-control" name="areas" id="areas">
                                        <option value="" disabled selected>Seleccione un almacen</option>
                                        <option value="1">La 19</option>
                                        <option value="2">La 21</option>

                                    </select>
                                </div>

                                <!-- Campo para agregar observaciones (row es para marcar el tamaño del campo de texto) -->
                                <div class="col">
                                    <label for="observaciones">observaciones</label>
                                    <textarea class="form-control" id="observaciones" name="observaciones" rows="5"></textarea>
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
                                    <a href="." class="btn btn-secondary">REGRESAR</a>
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
    <!-- Scripts -->
</body>

</html>