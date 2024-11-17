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


    <section class="d-flex flex-column " style="margin-top: 110px;">

        <div class="container"> <!-- todo el contenido ira dentro de esta etiqueta-->
            <form method="post" action="" id="f" target="_blank">
                <input type="text" name="accion" id="accion" style="display:none" />
                <h2 class="text-primary text-center">Reportes Existencias</h2>

                <div class="row">
                    <div class="col-md">
                        <hr />
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary" id="Generar" name="Generar">Crear Reporte PDF</button>
                        </div>

                    <div class="container ">
                    <div class="col-md-3">
                         <label for="ubi">Ubicación</label> 
                         <select name="ubi" id="ubi" class="form-select">
                        <option value='0' disabled selected>Seleccione una Ubicación</option> 
                          <option value="1">Almacen</option>
                          <option value="2">Mostrador</option>
                          </select>
                     </div>
                                                        
                </div>
            </form>
        </div> <!-- fin de container -->
    </section>


    <?php require_once("public/components/footer.php"); ?>
    <?php require_once("public/components/extra.php"); ?>

    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--<script type="text/javascript" src="public/js/"></script>-->
</body>

</html>