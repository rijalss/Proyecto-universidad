<!DOCTYPE html>
<html lang="ES">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
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
                    <h6 class="container text-center h2 text-primary">Gestionar Empleados</h6>
                    <br>
                    <form method="post">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <label for="cedulaEmpleado">Cédula del Empleado</label>
                                    <input class="form-control" type="text" id="cedulaEmpleado" name="cedulaEmpleado" required />
                                    <span id="scedula"></span>
                                </div>

                                <div class="col">
                                    <label for="nombreEmpleado">Nombre del Empleado</label>
                                    <input class="form-control" type="text" id="nombreEmpleado" name="nombreEmpleado" required />
                                    <span id="snombre"></span>
                                </div>

                                <div class="col">
                                    <label for="apellidoEmpleado">Apellido del Empleado</label>
                                    <input class="form-control" type="text" id="apellidoEmpleado" name="apellidoEmpleado" required />
                                    <span id="sapellido"></span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label for="correoEmpleado">Correo del Empleado</label>
                                    <input class="form-control" type="email" id="correoEmpleado" name="correoEmpleado" required />
                                    <span id="scorreoEmpleado"></span>
                                </div>
                                <div class="col">
                                    <label for="telefonoEmpleado">Número de Teléfono del Empleado</label>
                                    <input class="form-control" type="text" id="telefonoEmpleado" name="telefonoEmpleado" required />
                                    <span id="stelefonoEmpleado"></span>
                                </div>
                            </div>
                            <br>
                            <div class="row justify-content-center">
                                <div class="col">
                                    <label for="contrasena">Contraseña</label>
                                    <input class="form-control" type="password" id="contrasena" name="contrasena" required />
                                    <span id="scontrasena"></span>
                                </div>
                                <div class="col-4">
                                    <label for="clCargo">Cargo</label>
                                    <select class="form-control" name="clCargo" id="clCargo">
                                        <option value='disabled' disabled selected>Seleccione un cargo</option>
                                        <?php
                                        foreach ($cargos as $cargo) {
                                            echo "<option value='" . $cargo['clCargo'] . "'>" . $cargo['descCargo'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <span id="scargo" class="error"></span>
                                </div>
                                <div class="col-2">
                                    <label for="agregarCargo">&nbsp;</label>
                                    <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#agregarCargo">
                                        Agregar Cargo
                                    </button>
                                </div>
                                <!-- Modal Cargo -->
                                <div class="modal fade" id="agregarCargo" tabindex="-1" aria-labelledby="cargoModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cargoModal">Agregar Cargo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post">
                                                    <div class="mb-3">
                                                        <label for="descCargo" class="form-label">Nombre del Cargo</label>
                                                        <input type="text" class="form-control" id="descCargo" name="descCargo" required>
                                                    </div>
                                                    <div class="text-center">
                                                        <button id="incluirCargo" type="button" class="btn btn-primary">Agregar</button>
                                                        <button id="eliminarCargo" type="button" class="btn btn-danger">Eliminar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <br>
                                    <hr />
                                </div>
                            </div>
                            <div class="row container text-center">
                                <div class="col mb-4">
                                    <button type="button" class="btn btn-primary" id="incluir" name="incluir">INCLUIR</button>
                                </div>
                                <div class="col mb-4">
                                    <button type="button" class="btn btn-success" id="consultar" name="consultar">CONSULTAR</button>
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


    <div class="modal fade" tabindex="-1" aria-labelledby="empleadoModal" aria-hidden="true" role="dialog" id="modal1">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Listado de Empleados</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover" id="tablaEmpleado">
                        <thead>
                            <tr>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Cargo</th>
                            </tr>
                        </thead>
                        <tbody id="resultadoconsulta">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php require_once("public/commun/footer.php"); ?>
    <?php require_once("public/commun/extras.php"); ?>
    <!-- Footer -->
    </div> <!-- fin de container -->

    <!-- Scripts -->
    <script src="public/js/empleado.js"></script>
    <script src="public/bootstrap/js/sidebar.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>