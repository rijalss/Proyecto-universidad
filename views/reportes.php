<?php


// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['name'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header('Location: .');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/img/favicon.ico" >
    <title>Bienvenido</title>

    <link rel="stylesheet" href="public/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/bootstrap/css/style.css">
</head>

<body>
    <!-- Header -->
    <?php require_once("public/components/menu.php"); ?>
    <!-- Header -->

    <!-- Title -->

    <section class="d-flex flex-column align-items-center" style="margin-top: 110px;">
        <h1 class="display-4 text-center text-uppercase font-weight-bold">Gestionar <br> Reportes!</h1>
        <?php
        /*
        session_start();
        $nombreEmpleado = $_SESSION['nombreEmpleado'];
        echo "<h2 class=\"display-4 text-center text-uppercase font-weight-bold\">$nombreEmpleado!</h2>";
        */
        ?>

        <!-- Container de cards -->
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reporte de Productos</h5>
                        <p class="card-text">Gestiona los reportes de tus productos</p>
                        <a href="?pagina=Rproducto" class="btn btn-primary">Reporte de Productos</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reporte de Notas de Entrada</h5>
                        <p class="card-text">Gestiona los reportes de las notas de entrada</p>
                        <a href="?pagina=rentrada" class="btn btn-primary">Reporte de Notas de Entrada</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reporte de Notas de Salida</h5>
                        <p class="card-text">Gestiona los reportes de las notas de salida</p>
                        <a href="?pagina=rsalida" class="btn btn-primary">Reporte de Notas de Salida</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reporte de Proveedores</h5>
                        <p class="card-text">Gestiona los reportes de tus proveedores</p>
                        <a href="?pagina=rproveedor" class="btn btn-primary">Reporte de Proveedores</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card shadow w-100 h-100 p-3">
                    <div class="card-body">
                        <h5 class="card-title"><img width="20PX" src="public/icons/svg/journal-plus.svg" alt=""> Reporte de Empleados</h5>
                        <p class="card-text">Gestiona los reportes de tus empleados</p>
                        <a href="?pagina=Rempleado" class="btn btn-primary">Reporte de Empleados</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <!-- Footer -->
    <?php require_once("public/components/footer.php"); ?>
    <!-- Footer -->

    <!-- Scripts -->

    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts -->
</body>

</html>