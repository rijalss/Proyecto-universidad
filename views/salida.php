<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
    <!-- Header -->
    <?php require_once("public/components/extra.php"); ?>
    <?php require_once("public/components/menu.php"); ?>
    <!-- Header -->
    <br>
    <br>
    <br>
    <br>

    <div class="container-center m-5">
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="container text-center h2 text-primary">Gestionar <br> notas de salida</h6>
                    <br>
                    <form method="post" action="" id="">
                        <div class="container">
                            <div class="row">

                                <!-- Select para registrar en la base de datos -->

                                <div class="col">
                                    <label for="nombreProducto">Producto</label>
                                    <select class="form-control" name="nombreProducto" id="nombreProducto">
                                        <option value="" disabled selected>Seleccione un producto</option>
                                        <option value="1">Lapiz</option>
                                        <option value="2">Globos</option>
                                        <option value="3">Carrito</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="cantidadVenta">Cantidad del producto</label>
                                    <input class="form-control" type="number" id="cantidadVenta" name="cantidadVenta" />
                                    <span id="scantidadVenta"></span>
                                </div>
                                <div class="col">
                                    <label for="precioVenta">Precio en el mostrador</label>
                                    <input class="form-control" type="number" id="precioVenta" name="precioVenta" />
                                    <span id="sprecioVenta"></span>
                                </div>
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
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <?php require_once("public/components/footer.php"); ?>
    <!-- Footer -->
    <!-- fin de container -->

    <!-- Scripts -->
    <script src="public/bootstrap/js/sidebar.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/salida.js"></script>
    <!-- Scripts -->
</body>

</html>