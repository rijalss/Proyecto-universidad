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
    <title>Reportes Existencias</title>
    <link rel="icon" href="public/img/favicon.ico">
    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
    <!--Llamada a archivo modal.php, dentro de el hay una sección modal-->
    <?php require_once("public/components/menu.php"); ?>

<br><br><br>
<div class="container" style="max-width: 70%;">
    <section class="d-flex flex-column align-items-center py-5">
        <h2 class="text-primary text-center mb-4">Reportes Existencias</h2>
        <div class="card shadow mb-4 w-100">
            <div class="card-body p-4">
                <form method="post" action="" id="f" target="_blank">
                    <input type="text" name="accion" id="accion" style="display:none" />

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="ubi" class="form-label">Ubicación</label>
                            <select name="ubi" id="ubi" class="form-select">
                                <option  value='disabled' disabled selected>Seleccione una Ubicación</option>
                                <option value="1">Almacen</option>
                                <option value="2">Mostrador</option>
                            </select>
                            <span id="subi" class="form-text"></span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <hr />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary" id="Generar" name="Generar">Crear Reporte PDF</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>


    <?php require_once("public/components/footer.php"); ?>
    <?php require_once("public/components/extra.php"); ?>

    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="public/js/rexistencia.js"></script>
</body>

</html>