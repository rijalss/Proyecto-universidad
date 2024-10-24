<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['name'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header('Location: .');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargo</title>

    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>


<body>
    <!-- Header -->
    <?php require_once("public/components/menu.php"); ?>
    <!-- Header -->
    <div class="container" style="width: 75%;">
        <section class="d-flex flex-column align-items-center sm-4" style="margin-top: 110px;">
            <h2 class="text-primary text-center">Gestionar Cargo</h2>
            <div class="container">
                <div class="text-left">
                    <button class="btn btn-success" id="incluir">Registrar Cargo</button>
                </div>
            </div>
            <div class="container card shadow mb-4 ">
                <!-- todo el contenido ira dentro de esta etiqueta-->
                <br>
                <div class="container mt-3">
                </div>
                <div class="container text-center ">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="tablacargo">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
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
                    <h5 class="modal-title">Formulario de Cargos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="f" autocomplete="off">
                        <input autocomplete="off" type="text" class="form-control" name="accion" id="accion" style="display: none;">
                        <div class="container">
                            <div class="row">
                                <div class="col-6">
                                    <label for="codCargo">Código</label>
                                    <input class="form-control" type="text" id="codCargo" name="codCargo">
                                    <span id="scodCargo"></span>
                                </div>

                                <div class="col-6">
                                    <label for="nombreCargo">Nombre</label>
                                    <input class="form-control" type="text" id="nombreCargo" name="nombreCargo">
                                    <span id="snombreCargo"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <br>
                                <hr />
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
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
    </div>
    <!-- fin de container -->

    <!-- Scripts -->


    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="public/js/cargo.js"></script>
    <!-- Scripts -->
</body>

</html>