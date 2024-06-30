<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedor</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<div id="mensajes" style="display:none">
    <?php
    if (!empty($mensaje)) {
        echo $mensaje;
    }
    ?>
</div>

<body>
    <!-- Header -->
    <?php require_once("public/components/menu.php"); ?>
    <!-- Header -->

    <section class="d-flex flex-column align-items-center">
        <br><br><br><br>
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
                    <table class="table table-striped table-hover" id="tablaencargo">
                        <thead>
                            <tr>
                                <th>Proveedor</th>
                                <th>Factura</th>
                                <th>Fecha</th>
                                <th>Cantidad del Producto</th>
                                <th>Precio</th>
                                <th>Área</th>
                                <th>Almacén</th>
                                <th>Observaciones</th>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulario de Encargo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" id="f" autocomplete="off">
                        <input autocomplete="off" type="text" class="form-control" name="accion" id="accion" style="display: none;">
                        <div class="container">
                            <div class="row mb-3">

                                <div class="col-5">
                                    <label for="proveedor">Proveedor</label>
                                    <select class="form-control" name="proveedor" id="proveedor">
                                        <option value="Polar">Polar</option>
                                        <option value="Pilsen">Pilsen</option>
                                        <option value="Oreo">Oreo</option>
                                    </select>
                                    <span id="sproveedor"></span>
                                </div>
                                <div class="col-2">
                                    <label for="numFactura">N°Factura</label>
                                    <input class="form-control" type="text" id="numFactura" name="numFactura">
                                    <span id="snumFactura"></span>
                                </div>
                                <div class="col-5">
                                    <label for="fechaEncargo">Fecha</label>
                                    <input class="form-control" type="datetime-local" id="fechaEncargo" name="fechaEncargo">
                                    <span id="sfechaEncargo"></span>
                                </div>

                            </div>
                            <div class="col-5">
                                <label for="producto">Productos</label>
                                <select class="form-control" name="producto" id="producto">
                                    <option value="cerveza">cerveza</option>
                                    <option value="malta">malta</option>
                                    <option value="Galleta">Galleta</option>
                                </select>
                                <span id="sproducto"></span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="cantidadEncargo">Cantidad</label>
                                    <input class="form-control" type="text" id="cantidadEncargo" name="cantidadEncargo">
                                    <span id="scantidadEncargo"></span>
                                </div>
                                <div class="col-6">
                                    <label for="precioEncargo">Precio</label>
                                    <input class="form-control" type="text" id="precioEncargo" name="precioEncargo">
                                    <span id="sprecioEncargo"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">

                                <hr />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="area">Áreas</label>
                                <select class="form-control" name="area" id="area">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                                <span id="sarea"></span>
                            </div>
                            <div class="col-6">
                                <label for="almacen">Almacenes</label>
                                <select class="form-control" name="almacen" id="almacen">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                                <span id="salmacen"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">

                                <hr />
                            </div>
                        </div>
                        <div class="col">
                            <label for="observacion">observaciones</label>
                            <textarea class="form-control" id="observacion" name="observacion" rows="5" required></textarea>
                            <span id="sobservacion"></span>
                        </div>
                        <br>
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
    <!-- Fin del Modal -->

    <!-- Footer -->
    <?php require_once("public/components/footer.php"); ?>
    <?php require_once("public/components/extra.php"); ?>
    <!-- Footer -->
    </div> <!-- fin de container -->

    <!-- Scripts -->

    <script src="public/bootstrap/js/sidebar.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Pendiente a cambiar esto!!!!!!!!!!!!!!!!!!!!! -->
    <script type="text/javascript" src="public/js/proveedor.js"></script>
    <!-- Scripts -->
</body>

</html>