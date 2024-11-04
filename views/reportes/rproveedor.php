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
    <title>Reportes Proveedor</title>
    <!-- Enlace al favicon personalizado -->
    <link rel="icon" href="public/img/favicon.ico">


    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
    <!--Llamada a archivo modal.php, dentro de el hay una sección modal-->
    <?php require_once("public/components/menu.php"); ?>

    <section class="d-flex flex-column align-items-center">
        <br><br><br><br>
        <h2 class="text-primary text-center">Reportes Proveedor</h2>



        <div class="container"> <!-- todo el contenido ira dentro de esta etiqueta-->
            <form method="post" action="" id="f" target="_blank">
                <input type="text" name="accion" id="accion" style="display:none" />





                <div class="row">
                    <div class="col">
                        <hr />
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="rifProveedor">Rif</label>
                        <input class="form-control" type="text" id="rifProveedor" name="rifProveedor" />
                        <span id="srifProveedor"></span>
                    </div>
                    <div class="col">
                        <label for="nombreProveedor">Nombre</label>
                        <input class="form-control" type="text" id="nombreProveedor" name="nombreProveedor" />
                        <span id="snombreProveedor"></span>
                    </div>                        
                </div>



                <div class="row">
                    <div class="col">
                        <hr />
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary" id="generar" name="generar">Crear Reporte PDF</button>
                    </div>

                </div>


            </form>
        </div> <!-- fin de container -->
    </section>

    <!-- seccion del modal productos -->
    </div>

    <!--fin de seccion modal-->

    <?php require_once("public/components/footer.php"); ?>
    <?php require_once("public/components/extra.php");

    ?>

    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>


</body>

</html>