<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área</title>
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
    <div class="container" style="width: 75%;">
        <section class="d-flex flex-column align-items-center sm-4">
            <br><br><br><br>
            <h2 class="text-primary text-center">Gestionar Área</h2>
            <div class="container">
                <div class="text-left">
                    <button class="btn btn-success" id="incluir">Registrar Área</button>
                </div>
            </div>
            <div class="container card shadow mb-4 ">
                <!-- todo el contenido ira dentro de esta etiqueta-->
                <br>
                <div class="container mt-3">
                </div>
                <div class="container text-center ">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tablaarea">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th class="text-nowrap" style="max-width: 120px; overflow: hidden; text-overflow: ellipsis;">Almacén</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="resultadoconsulta"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- fin de container -->
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modal1">
        <div class="modal-dialog modal-md" role="document"> <!-- Cambiado modal-lg a modal-md -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulario de Áreas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="f" autocomplete="off">
                        <input autocomplete="off" type="text" class="form-control" name="accion" id="accion" style="display: none;">
                        <div class="container">
                            <div class="row-6">
                                <div class="col-12">
                                    <label for="codArea">Código</label>
                                    <input class="form-control" type="text" id="codArea" name="codArea">
                                    <span id="scodArea"></span>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="nombreArea" class="form-label">Nombre</label>
                                        <input class="form-control" type="text" id="nombreArea" name="nombreArea">
                                        <span id="snombreArea"></span>
                                    </div>
                                    <div class="col-6">
                                        <label for="almacen" class="form-label">Almacén</label>
                                        <select class="form-control" name="almacen" id="almacen">
                                            <option value='disabled' disabled selected>Seleccione un almacén</option>
                                            <?php
                                            foreach ($almacenes as $almacen) {
                                                echo "<option value='" . $almacen['clAlmacen'] . "'>" . $almacen['nombreAlmacen'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        <span id="salmacen" class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <br>
                                <hr />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-primary" id="proceso"></button>
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
    </div>
    <!-- fin de container -->

    <!-- Scripts -->

    <script src="public/bootstrap/js/sidebar.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="public/js/area.js"></script>
    <!-- Scripts -->
</body>

</html>