<?php

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
    <title>Reportes Empleado</title>
    <!-- Enlace al favicon personalizado -->
    <link rel="icon" href="public/img/favicon.ico">


    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
    <!--Llamada a archivo modal.php, dentro de el hay una sección modal-->
    <?php require_once("public/components/menu.php"); ?>
    <br><br><br>
    <div class="container" style="width: 70%;">
        <section class="d-flex flex-column align-items-md-center py-5">
            <h2 class="text-primary text-md-center mb-4">Reportes Empleado</h2>
            <div class="container card shadow mb-4 ">
                <div class="container p-4">
                    <form method="post" action="" id="f" target="_blank">
                        <input type="text" name="accion" id="accion" style="display:none" />

            <div class="row mb-3">
                <div class="col-md">
                    <label for="cedulaEmpleado" class="form-label">Cédula</label>
                    <input class="form-control" type="text" id="cedulaEmpleado" name="cedulaEmpleado" />
                    <span id="scedulaEmpleado" class="form-text"></span>
                </div>
                <div class="col-md">
                    <label for="nombreEmpleado" class="form-label">Nombre</label>
                    <input class="form-control" type="text" id="nombreEmpleado" name="nombreEmpleado" />
                    <span id="snombreEmpleado" class="form-text"></span>
                </div>
                <div class="col-md">
                    <label for="apellidoEmpleado" class="form-label">Apellido</label>
                    <input class="form-control" type="text" id="apellidoEmpleado" name="apellidoEmpleado" />
                    <span id="sapellidoEmpleado" class="form-text"></span>
                </div>
                <div class="col-md">
                    <label for="cargo" class="form-label">Cargo</label>
                    <select class="form-select" name="cargo" id="cargo">
                        <option value=' ' disabled selected>Seleccione un cargo</option>
                        <?php
                        foreach ($cargos as $cargo) {
                            echo "<option value='" . $cargo['clCargo'] . "'>" . $cargo['nombreCargo'] . "</option>";
                        }
                        ?>
                    </select>
                    <span id="scargo" class="form-text text-danger"></span>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md">
                    <hr />
                </div>
            </div>

            <div class="row">
                <div class="col-md text-center">
                    <button type="submit" class="btn btn-primary" id="generar" name="generar">Crear Reporte PDF</button>
                </div>
            </div>
        </form>
    </div>
</section>


    <!-- seccion del modal productos -->
    </div>

    <!--fin de seccion modal-->

    <?php require_once("public/components/footer.php"); ?>
    <?php require_once("public/components/extra.php");

    ?>

    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="public/js/Rempleado.js"></script>

</body>

</html>